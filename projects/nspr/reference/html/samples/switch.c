/* Copyright © 1998 Netscape Communications Corporation */

#include "prinit.h"
#include "prlock.h"
#include "prcvar.h"
#include "prmem.h"
#include "prinrval.h"
#include "prlog.h"
#include "prthread.h"
#include "prprf.h"
#include "plerror.h"

#define INNER_LOOPS 100
#define DEFAULT_LOOPS 100
#define DEFAULT_THREADS 10

typedef struct Shared
{
    PRLock *ml;
    PRCondVar *cv;
    PRBool twiddle;
    PRThread *thread;
    struct Shared *next;
} Shared;

static PRFileDesc *debug_out = NULL;
static PRBool debug_mode = PR_FALSE, verbosity = PR_TRUE, failed = PR_FALSE;
static Shared home;

static void Help(void);
static void PR_CALLBACK Notified(void *arg);
static PRIntn PR_CALLBACK Switch(PRIntn argc, char **argv);

/* Root function for the threads in this sample (except primordial thread, which runs main) */
static void PR_CALLBACK Notified(void *arg)
{
    Shared *shared = arg;
    PRStatus status = PR_SUCCESS;
    while (PR_SUCCESS == status)
    {
        PR_Lock(shared->ml);
        while (shared->twiddle && (PR_SUCCESS == status))
            status = PR_WaitCondVar(shared->cv, PR_INTERVAL_NO_TIMEOUT);
        if (verbosity) PR_fprintf(debug_out, "+");
        shared->twiddle = PR_TRUE;
        shared->next->twiddle = PR_FALSE;
        PR_NotifyCondVar(shared->next->cv);
        PR_Unlock(shared->ml);
    }
}  /* Notified */

static PRIntn PR_CALLBACK Switch(PRIntn argc, char **argv)
{
    PRStatus status;
    PRBool help = PR_FALSE;
    PRUintn concurrency = 1;
    Shared *shared, *link;
    PRIntervalTime timein, timeout;
    PRBool global_threads = PR_FALSE;
    PRThreadScope thread_scope = PR_LOCAL_THREAD;
    PRUintn thread_count, inner_count, loop_count, average;
    PRUintn thread_limit = DEFAULT_THREADS, loop_limit = DEFAULT_LOOPS;
   
    if (help) return -1;

    if (PR_TRUE == debug_mode)
    {
        debug_out = PR_STDOUT;
        PR_fprintf(debug_out, "Test parameters\n");
        PR_fprintf(debug_out, "\tThreads involved: %d\n", thread_limit);
        PR_fprintf(debug_out, "\tIteration limit: %d\n", loop_limit);
        PR_fprintf(debug_out, "\tConcurrency: %d\n", concurrency);
        PR_fprintf(
            debug_out, "\tThread type: %s\n",
            (PR_GLOBAL_THREAD == thread_scope) ? "GLOBAL" : "LOCAL");
    }

    PR_SetConcurrency(concurrency);

/*'home' is "Shared" object for the primordial thread, at the end of the chain. */
    link = &home;
    home.ml = PR_NewLock();
    home.cv = PR_NewCondVar(home.ml);
    home.twiddle = PR_TRUE;
    home.next = NULL;
    timeout = 0;

/* Create "thread_limit" number of additional threads, each with its own "Shared" object. */
    for (thread_count = 1; thread_count <= thread_limit; ++thread_count)
    {
        shared = PR_NEWZAP(Shared);
        shared->ml = home.ml;
        shared->cv = PR_NewCondVar(home.ml);
        shared->twiddle = PR_TRUE;
        shared->next = link;
        link = shared;
        shared->thread = PR_CreateThread(
            PR_USER_THREAD, Notified, shared,
            PR_PRIORITY_HIGH, thread_scope,
            PR_JOINABLE_THREAD, 0);
        PR_ASSERT(shared->thread != NULL);
        if (NULL == shared->thread)
            failed = PR_TRUE;
    }

/* "Shared" now points to the head of the chain, and "home" is the tail of the chain. */
    for (loop_count = 1; loop_count <= loop_limit; ++loop_count)
    {
        timein = PR_IntervalNow();
        for (inner_count = 0; inner_count < INNER_LOOPS; ++inner_count)
        {
            PR_Lock(home.ml);
            home.twiddle = PR_TRUE;
            shared->twiddle = PR_FALSE;
            PR_NotifyCondVar(shared->cv);
            while (home.twiddle)
            {
                status = PR_WaitCondVar(home.cv, PR_INTERVAL_NO_TIMEOUT);
                if (PR_FAILURE == status)
                    failed = PR_TRUE;
            }
            PR_Unlock(home.ml);
        }
        timeout += (PR_IntervalNow() - timein);
    }

    if (debug_mode)
    {
        average = PR_IntervalToMicroseconds(timeout)
            / (INNER_LOOPS * loop_limit * thread_count);
        PR_fprintf(
            debug_out, "Average switch times %d usecs for %d threads\n",
            average, thread_limit);
    }
    /* Test completed. Remainder of sample cleanly shuts down the test. */
    link = shared;
    for (thread_count = 1; thread_count <= thread_limit; ++thread_count)
    {
        if (&home == link) break;
        status = PR_Interrupt(link->thread);
        if (PR_SUCCESS != status)
        {
            failed = PR_TRUE;
            if (debug_mode)
                PL_FPrintError(debug_out, "Failed to interrupt");
        }
        link = link->next; 
    }

    for (thread_count = 1; thread_count <= thread_limit; ++thread_count)
    {
        link = shared->next;
        status = PR_JoinThread(shared->thread);
        if (PR_SUCCESS != status)
        {
            failed = PR_TRUE;
            if (debug_mode)
                PL_FPrintError(debug_out, "Failed to join");
        }
        PR_DestroyCondVar(shared->cv);
        PR_DELETE(shared);
        if (&home == link) break;
        shared = link;
    }
    PR_DestroyCondVar(home.cv);
    PR_DestroyLock(home.ml);

    PR_fprintf(PR_STDOUT, ((failed) ? "FAILED\n" : "PASSED\n"));
    return ((failed) ? 1 : 0);
}  /* Switch */

PRIntn main(PRIntn argc, char **argv)
{
    PRIntn result;
    PR_STDIO_INIT();
    result = PR_Initialize(Switch, argc, argv, 0);
    return result;
}  /* main */

/* switch.c */
