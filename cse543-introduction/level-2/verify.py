#!/opt/pwn.college/python

from typing import Tuple
import sys
import os
import zipfile
import subprocess
import json
import tempfile
import shutil


class Hacker:
    def grade(self, f) -> Tuple[bool, str]:

        # unzip it
        try:
            zf = zipfile.ZipFile(f)
        except zipfile.BadZipfile:
            # invalid zip file
            return 0, "The ZIP file is invalid."
        namelist = zf.namelist()

        if len(namelist) != 1:
            the_name = next(iter(n for n in namelist if not n.endswith("/")))
        else:
            the_name = namelist[0]
        if the_name != 'hacker.json':
            return False, "The name of the JSON file is incorrect."

        # Apparently zipfile does not support AES-256 encrypted zip files :(

        with tempfile.TemporaryDirectory() as base_dir:
            os.chmod(base_dir, 0o777)
            shutil.copyfile(f, os.path.join(base_dir, "hacker.zip"))
            os.chmod(os.path.join(base_dir, "hacker.zip"), 0o777)
            proc = subprocess.Popen(["/usr/bin/7z", "x", "-phacker", "hacker.zip"], cwd=base_dir,
                                      stdout=subprocess.PIPE, stderr=subprocess.PIPE, stdin=subprocess.DEVNULL)
            stdout, stderr = proc.communicate()
            if not os.path.isfile(os.path.join(base_dir, the_name)):
                return False, "Unzipping failed.\n7z returned:" + stdout.decode("utf-8")

            with open(os.path.join(base_dir, the_name), "r") as json_:
                data = json_.read()

            # Is the JSON file parseable?
            try:
                j = json.loads(data)
            except ValueError:
                j = None
                return False, "The JSON file is not a legal JSON string."

            if j is not None and not ('email' in j and 'legal_name' in j and 'handle' in j):
                return False, "Content in the JSON file is not completely correct."

            return True, "Congrats!"


def main():
    if len(sys.argv) != 2:
        print(f"Usage: {sys.argv[0]} path_to_your_hacker_dot_zip")
        return
    f = sys.argv[1]
    if not f.endswith("hacker.zip"):
        print("You must name your submission \"hacker.zip\".")
        return

    r, comment = Hacker().grade(f)
    if r:
        with open("/flag", "r") as f:
            print("Your flag is:", f.read())
    print(comment)


if __name__ == "__main__":
    main()

