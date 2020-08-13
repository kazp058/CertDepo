#!/usr/bin/python3.7

from PIL import Image, ImageDraw, ImageFont
import string
import sys
import os
import qrcode


def getparam(line):
    imagename = line[1]
    username = " ".join(line[3:line.index('-t')])
    title = " ".join(line[line.index('-t') + 1:line.index('-k')])
    token = line[line.index('-k')+1]
    issuerName = " ".join(line[line.index('-i') + 1:line.index('-c')])
    idcert = line[line.index('-c') + 1]
    return imagename, username, title, token, issuerName, idcert


line = sys.argv[1:]

imagename, username, title, token, issuerName, idcert = getparam(line)
print(os.getcwd())
