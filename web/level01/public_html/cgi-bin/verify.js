#!/usr/bin/python3
import os
import cgi
import random
import tempfile
import re
import socket
import sys

# debugging
# import cgitb; cgitb.enable()
form = cgi.FieldStorage()
print("Content-Type: text/html\n")

if not "HTTP_REFERER" in os.environ:
	print("""function verify(form) {alert("Not really!")}""")
	sys.exit(0)

if os.environ['HTTP_REFERER'].find("form.html") < 0:
	print("""function verify(form) {alert("[%s]");}""" % os.environ['HTTP_REFERER'])
	sys.exit(0)

print("""
function verify(form) {
	if ((form.username.value == "script") && (form.password.value == "kiddie")) {
	  alert("You got it! The secret is: THISISTHESECRET");
        } else {
          alert("Wrong password!");
        }
}""")
