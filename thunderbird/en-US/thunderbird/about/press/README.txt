How to create a news story
===============================
1. Copy an existing story from en-US/news/stories/, making sure to name it in
   the format of YYYY-MM-DD-##.story.php.
   
2. Fill in the title, date, snippet, and body of the story. HTML can be used.

3. If the story is to be featured on the home page and Latest News, open
   en-US/news/stories/latest.inc.php and add the story's filename to the
   list. The list is displayed in the order of the array, whereas in the
   archives, it is with the most recent first.
   
4. If the story has an associated FAQ, the FAQ template should be copied from
   en-US/news/faq and filled in.