#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <stdint.h>
#include <unistd.h>
#include <openssl/sha.h>

void sha256(const uint8_t* input, size_t n, uint8_t* hash)
{
    SHA256_CTX sha256;
    SHA256_Init(&sha256);
    SHA256_Update(&sha256, input, n);
    SHA256_Final(hash, &sha256);
}

int main()
{
    uint8_t buffer_0[256];
    uint8_t buffer_1[256];
    ssize_t n;
    unsigned long long target;

    if ((n = read(0, buffer_0, sizeof(buffer_0))) != sizeof(buffer_0)) {
        puts("Not enough bytes for the first buffer!");
        exit(1);
    }
    if ((n = read(0, buffer_1, sizeof(buffer_1))) != sizeof(buffer_1)) {
        puts("Not enough bytes for the second buffer!");
        exit(1);
    }

    int diff = 0;
    for (int i = 0; i < sizeof(buffer_0); ++i) {
        if (buffer_0[i] != buffer_1[i]) {
            diff = 1;
        }
    }
    if (!diff) {
        puts("The two buffers cannot have the exact same content!");
        exit(1);
    }

    // hash
    uint8_t hash_0[SHA256_DIGEST_LENGTH];
    uint8_t hash_1[SHA256_DIGEST_LENGTH];
    sha256(buffer_0, sizeof(buffer_0), hash_0);
    sha256(buffer_1, sizeof(buffer_1), hash_1);
    if (strcmp(hash_0, hash_1)) {
        puts("The hashes are not the same. Hash collision attack failed! No bread for you.");
        exit(1);
    }

    // Trash the stack!
    memcpy(buffer_0 + 512, buffer_0, sizeof(buffer_0));
    return 0;
}
