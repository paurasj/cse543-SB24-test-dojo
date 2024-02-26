#!/opt/pwn.college/python


def main():
    with open("/flag", "r") as f:
        print("Your flag is:", f.read())


if __name__ == "__main__":
    main()

