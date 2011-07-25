#! gmake

MOD_DEPTH = ../../../../nspr20

include $(MOD_DEPTH)/config/config.mk
DIRS = dll

CSRCS =             \
		t0.c\
	t1.c\
	t2.c\
	t3.c\
	t4.c\
	t5.c\
	t6.c\
	t7.c\
	t8.c\
	t9.c\
	t10.c\
	t11.c\
	t12.c\
	t13.c\
	t14.c\
	t15.c\
	t16.c\
	t17.c\
	t18.c\
	t19.c\
	t20.c\
	t21.c\
	t22.c\
	t23.c\
	t24.c\
	t25.c\
	t26.c\
	t27.c\
	t28.c\
	t29.c\
	t30.c\
	t31.c\
	t32.c\
	t33.c\
	t34.c\
	t35.c\
	t36.c\
	t37.c\
	t38.c\
	t39.c\
	t40.c\
	t41.c\
 \
	$(NULL)

ifeq ($(OS_ARCH), WINNT)
PROG_SUFFIX = .exe
else
PROG_SUFFIX =
endif

PROGS = $(addprefix $(OBJDIR)/, $(CSRCS:.c=$(PROG_SUFFIX)))

TARGETS = $(PROGS)

INCLUDES = -I$(DIST)/include/private -I$(DIST)/include 

# Setting the variables LDOPTS and LIBPR.  We first initialize
# them to the default values, then adjust them for some platforms.
LDOPTS = -L$(DIST)/lib
LIBPR = -lnspr
LIBPLC = -lplc

ifeq ($(OS_ARCH), WINNT)
ifeq ($(OS_TARGET), WIN16)
  LIBPR = $(DIST)/lib/nspr20.lib
  LIBPLC= $(DIST)/lib/plc20.lib
else
LDOPTS = -NOLOGO -DEBUG -DEBUGTYPE:CV -INCREMENTAL:NO
LIBPR = $(DIST)/lib/libnspr20.$(LIB_SUFFIX)
LIBPLC= $(DIST)/lib/libplc20.$(LIB_SUFFIX)
endif
endif

ifneq ($(OS_ARCH), WINNT)
PWD = $(shell pwd)
endif

ifeq ($(OS_ARCH), IRIX)
LDOPTS += -rpath $(PWD)/$(DIST)/lib
endif

ifeq ($(OS_ARCH), OSF1)
LDOPTS += -rpath $(PWD)/$(DIST)/lib -lpthread
endif

ifeq ($(OS_ARCH), HP-UX)
LDOPTS += -Wl,+s,+b,$(PWD)/$(DIST)/lib
endif

# AIX
ifeq ($(OS_ARCH),AIX)
LDOPTS += -blibpath:.:$(PWD)/$(DIST)/lib:/usr/lib/threads:/usr/lpp/xlC/lib:/usr/lib:/lib                                        
LIBPR = -lnspr_shr
LIBPLC = -lplc_shr
endif

# Solaris
ifeq ($(OS_ARCH), SunOS)
ifneq ($(OS_RELEASE), 4.1.3_U1)
ifdef NS_USE_GCC
LDOPTS += -Xlinker -R -Xlinker $(PWD)/$(DIST)/lib
else
LDOPTS += -R $(PWD)/$(DIST)/lib
endif
endif

# SunOS 5.4 and 5.5 need to link with -lthread or -lpthread,
# even though we already linked with these system libraries
# when we built libnspr.so.
ifeq ($(OS_RELEASE), 5.4)
EXTRA_LIBS = -lthread
endif

ifeq ($(OS_RELEASE), 5.4_i86pc)
EXTRA_LIBS = -lthread
endif

ifeq ($(OS_RELEASE), 5.5)
ifdef USE_PTHREADS
EXTRA_LIBS = -lpthread
else
EXTRA_LIBS = -lthread
endif
endif
endif # SunOS

#####################################################
#
# The rules
#
#####################################################

include $(MOD_DEPTH)/config/rules.mk

AIX_PRE_4_2 = 0
ifeq ($(OS_ARCH),AIX)
ifneq ($(OS_RELEASE),4.2)
ifneq ($(USE_PTHREADS), 1)
#AIX_PRE_4_2 = 1
endif
endif
endif

ifeq ($(AIX_PRE_4_2),1)

# AIX releases prior to 4.2 need a special two-step linking hack
# in order to both override the system select() and be able to 
# get at the original system select().
#
# We use a pattern rule in ns/nspr20/config/rules.mk to generate
# the .o file from the .c source file, then do the two-step linking
# hack below.

$(OBJDIR)/%: $(OBJDIR)/%.o
	@$(MAKE_OBJDIR)
	rm -f $@ $(AIX_TMP)
	$(CC) $(AIX_LINK_OPTS) -o $(AIX_TMP) $< $(DIST)/lib/libnspr.a
	$(CC) -o $@ $(AIX_TMP) $(AIX_WRAP)
	rm -f $(AIX_TMP)

else

# All platforms that are not AIX pre-4.2.


# ifeq ($(USE_PTHREADS), 1)
# $(OBJDIR)/attach: $(OBJDIR)/attach.o
# 	@$(MAKE_OBJDIR)
# 	$(CC) $< $(LDOPTS) $(LIBPR) $(LIBPLC) -lpthread -o $@
# endif


$(OBJDIR)/%$(PROG_SUFFIX): $(OBJDIR)/%.o
	@$(MAKE_OBJDIR)
ifeq ($(OS_ARCH), WINNT)
ifeq ($(OS_TARGET),WIN16)
	echo system windows >w16link
	echo option map >>w16link
	echo name $@  >>w16link
	echo file >>w16link
	echo $<  >>w16link
	echo library  >>w16link
	echo $(LIBPR),	     >>w16link
	echo $(LIBPLC),		 >>w16link
	echo winsock.lib     >>w16link
	wlink @w16link.
else
	link $(LDOPTS) $< $(LIBPR) $(LIBPLC) wsock32.lib -out:$@
endif
else
	$(CC) $(XCFLAGS) $< $(LDOPTS) $(LIBPR) $(LIBPLC) $(EXTRA_LIBS) -o $@
endif

endif

export:: $(TARGETS)
install:: export
clean::
	rm -f $(TARGETS)
