#include <stdio.h>
#include <stdlib.h>

typedef void (*funcptr_t)();


int win()
{
    printf("Great Job\n");
    exit(0);
}

int main()
{
    int n = 0;
    unsigned long long target;

    printf("This is your fourth challenge. No more source code!\n");
    scanf("%d", &n);
    scanf("%llu", &target);
    if (n == 0xa0ce1337) {
        funcptr_t funcptr = (funcptr_t)target;
        funcptr();
    }
}
