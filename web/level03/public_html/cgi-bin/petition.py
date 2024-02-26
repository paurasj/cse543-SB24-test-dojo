#!/usr/bin/python3
import cgi
import html
import random
import os
import tempfile
import os.path
import hashlib
#debugging
import cgitb; cgitb.enable()

page = """
<html>
<head><title>Petition</title></head>
<body>
%s
</body>
</html>
"""

def sanitize(s):
	s = html.escape(s)
	s = s.replace('\n', ' ').replace('\r', '')
	return s

form = cgi.FieldStorage()
print("Content-Type: text/html")
print("")
content = "There has been an error, I am confused... Maybe you should provide your ID and see what you submitted..."

# Entry retrieval
if "first" in form:
    first = form["first"].value;
else:
    first = ""
if "last" in form:
    last = form["last"].value;
else:
    last = ""
if "email" in form:
    email = form["email"].value;
else:
    email = ""
if "comment" in form:
    comment = form["comment"].value;
else:
    comment = ""
if "id" in form:
    id = form["id"].value;
else:
    id = ""

debug = 0
if debug == 1:
    first ="John"
    last = "Doe"
    email = "jdoe@nowhere.com"
    comment = "Tonight we dine in hell!"
    id = ""
elif debug == 2:
    first =""
    last = ""
    email = ""
    comment = ""
    id = "b6a6e056f2f6103d1a164b7c3a36d40a"

# Comment retrieval
if first == "" and last == "" and email == "" and comment == "" and id != "":
    content = "These are not the IDs you are looking for..."
    try:
        f = open("signers.txt", "r")
        for l in f:
            fields = l.split(':')
            if len(fields) < 5:
            	continue
            if fields[0] == id:
                content = "\nYour comment was: %s\n" % fields[4]
                break;
        f.close()
    except IOError as err:
        print("Error %s" % err)

# Petition submission
if first != "" and last != "" and email != "" and comment != "" and id == "":
    first = sanitize(first)
    last = sanitize(last)
    email = sanitize(email)
    comment = sanitize(comment)

    id = hashlib.md5(email.encode("ascii")).hexdigest()

    try:
        f = open("signers.txt", "a+")
        entry = "%s:%s:%s:%s:%s\n" % (id, last, first, email, comment)
        f.write(entry)
        f.close()
        content = "\nThanks for signing the petition.<br/>\nYour ID is %s\n" % id
        #chmod("signers.txt", "700")
    except:
        content = "\nThere was an error saving your message\n"

print(page % content)

