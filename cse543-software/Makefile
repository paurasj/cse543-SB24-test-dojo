
all: level-00/prog \
	level-01/prog \
	level-10/prog \
	level-11/prog \
	level-20/prog \
	level-21/prog \
	level-30/prog \
	level-31/prog \
	level-40/prog \
	level-41/prog \
	level-50/prog \
	level-51/prog \
	level-60/prog \
	level-61/prog \
	level-70/prog \
	level-71/prog \
	level-80/prog \
	level-81/prog \
	level-90/prog \
	level-91/prog

level-00/prog: level-00/main.c
	gcc level-00/main.c -o level-00/prog -fcf-protection=none

level-01/prog: level-01/main.c
	gcc level-01/main.c -o level-01/prog -fcf-protection=none

level-10/prog: level-10/main.c
	gcc level-10/main.c -o level-10/prog -fcf-protection=none

level-11/prog: level-11/main.c
	gcc level-11/main.c -o level-11/prog -fcf-protection=none

level-20/prog: level-20/main.c
	gcc level-20/main.c -o level-20/prog -no-pie -fno-pic -fcf-protection=none

level-21/prog: level-21/main.c
	gcc level-21/main.c -o level-21/prog -no-pie -fno-pic -fcf-protection=none

level-30/prog: level-30/main.c
	gcc level-30/main.c -o level-30/prog -no-pie -fno-pic -fcf-protection=none

level-31/prog: level-31/main.c
	gcc level-31/main.c -o level-31/prog -no-pie -fno-pic -fcf-protection=none

level-40/prog: level-40/main.c
	gcc level-40/main.c -o level-40/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack

level-41/prog: level-41/main.c
	gcc level-41/main.c -o level-41/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack

level-50/prog: level-50/main.c
	gcc level-50/main.c -o level-50/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack

level-51/prog: level-51/main.c
	gcc level-51/main.c -o level-51/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack

level-60/prog: level-60/main.c
	gcc level-60/main.c -o level-60/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack

level-61/prog: level-61/main.c
	gcc level-61/main.c -o level-61/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack

level-70/prog: level-70/main.c
	gcc level-70/main.c -o level-70/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack

level-71/prog: level-71/main.c
	gcc level-71/main.c -o level-71/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack

level-80/prog: level-80/main.c
	gcc level-80/main.c -o level-80/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack

level-81/prog: level-81/main.c
	gcc level-81/main.c -o level-81/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack

level-90/prog: level-90/main.c
	gcc level-90/main.c -o level-90/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack -lssl -lcrypto
	strip --strip-all level-90/prog

level-91/prog: level-91/main.c
	gcc level-91/main.c -o level-91/prog -no-pie -fno-pic -fcf-protection=none -fno-stack-protector -zexecstack -lssl -lcrypto
	strip --strip-all level-91/prog

clean:
	rm -f */prog

