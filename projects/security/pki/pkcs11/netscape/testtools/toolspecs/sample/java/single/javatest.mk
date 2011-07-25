#! gmake

PROGRAM = /tools/ns/bin/javac

CSRCS =             		TestTools/Replacer/t.java 
 	$(NULL)

all:	
	@for file in $(CSRCS); 	   do $(PROGRAM) $$file; 	   echo compiled $$file; 	done	
