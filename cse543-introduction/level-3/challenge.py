#!/opt/pwn.college/python

from typing import Tuple
import hashlib
import random
import string


def gen_plain_cipher() -> Tuple[str, str]:
    plain_text = "".join([random.choice(string.digits + string.ascii_uppercase) for _ in range(16)])
    cipher_text = hashlib.sha256(plain_text.encode("ascii")).hexdigest()
    return plain_text, cipher_text


def main():
    print("Regardless of what programming languages you use, a byte is always a byte, and crypto algorithms are still crypto algorithms.")
    plain_text, cipher_text = gen_plain_cipher()
    print(f"Please submit the SHA256 hash of the plain text string \"{plain_text}\" (without quotes).")
    print("Your hash should be encoded in hexadecimal; it should only contain the following characters: 0-9 and a-f.")
    input_str = input("Your answer: ")
    if input_str.strip(" \n\r") == cipher_text:
        with open("/flag", "r") as f:
            print("Congrats! Your flag:", f.read())
    else:
        print("Incorrect input. Try again!")


if __name__ == "__main__":
    main()

