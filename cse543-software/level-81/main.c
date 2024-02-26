#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <stdint.h>
#include <unistd.h>

#define POLYNOMIAL 0x04c11db7L
uint32_t crc_table[256];


void gen_crc_table()
{
    uint16_t i, j;
    uint32_t crc_accum;

    for (i=0; i<256; i++)
    {
        crc_accum = ((uint32_t)i << 24);
        for (j = 0;j < 8; j++)
        {
            if (crc_accum & 0x80000000L)
                crc_accum = (crc_accum << 1) ^ POLYNOMIAL;
            else
                crc_accum = (crc_accum << 1);
        }
        crc_table[i] = crc_accum;
    }
}

uint32_t update_crc(uint32_t crc_accum, uint8_t *data_blk_ptr, uint32_t data_blk_size)
{
    uint32_t i, j;

    for (j=0; j < data_blk_size; j++)
    {
        i = ((int) (crc_accum >> 24) ^ *data_blk_ptr++) & 0xFF;
        crc_accum = (crc_accum << 8) ^ crc_table[i];
    }
    crc_accum = ~crc_accum;
    return crc_accum;
}


void parse(uint8_t* buffer, uint32_t buf_size)
{
    // byte 0 and byte 1 specifies the real size of the buffer
    int16_t size = *(int16_t*)buffer;
    // byte 2 to byte 5 specifies the CRC of the buffer
    uint32_t crc = *(uint32_t*)(buffer + 4);
    // CRC check
    if (update_crc(-1, buffer + 6, buf_size - 6) != 0x0a9d240a) {
        puts("CRC check failed.");
        return;
    }
    if (size > buf_size) {
        puts("Incomplete packet.\n");
        return;
    }
    // CRC check passed
    uint8_t *copy = malloc(buf_size - 6);
    memcpy(copy, buffer + 6, size);
}


int main()
{
    uint8_t buffer[256];
    ssize_t n;
    unsigned long long target;

    gen_crc_table();
    if ((n = read(0, buffer, sizeof(buffer))) != sizeof(buffer)) {
        puts("Not enough bytes!");
    }
    parse(buffer, n);
    exit(1);
}
