TOOLS=../tools
YUICOMPRESSOR=java -jar $(TOOLS)/yuicompressor.jar

SOURCES=$(wildcard *.css */*.css)
MINIFY_SOURCES=$(SOURCES:.css=.css.min)

all: $(MINIFY_SOURCES)

%.css.min: %.css Makefile
	$(YUICOMPRESSOR) --type css -o $@ $<

