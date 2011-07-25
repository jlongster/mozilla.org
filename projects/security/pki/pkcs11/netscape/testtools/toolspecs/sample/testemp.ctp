#include <stdio.h>

#replacer-define THISISDEFINED 0

int main() {
	$[Do-A-Chain];
	$[Do-Something-else];


#replacer-if $[Test-a-define]==true
	printf("The define is true\n");
#replacer-else
#replacer-if $[Test-a-define]==false
	printf("The define is false\n");
#replacer-else
#replacer-if $[Test-a-define]==true || $[Test-a-define] == false
	printf("This should not be here....\n");
#replacer-else
	printf("The define is neither\n");
#replacer-endif
#replacer-define THISISDEFINED 1
#replacer-endif
#replacer-endif

#replacer-if $[THISISDEFINED]==1
	printf("The replacer-define works!\n");
#replacer-endif

#replacer-if $[COMBO-NUMBER]==7
	printf("this is the seventh combination.\n");
#replacer-endif
	
	printf("The line number is $[LINE-NUMBER].\n");
	printf("this should equal 34 == $[TEMPLATE-LINE-NUMBER].\n");

	if (($[COMBO-NUMBER] % 2) == 0)
		return 0;
	else
		return $[LINE-NUMBER];

}







