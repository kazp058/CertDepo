#!/usr/bin/env python3
from PIL import Image, ImageDraw, ImageFont
import string
import sys


def generateCert(image, name, title, token, issuer):
    image = Image.open("certificados/" + image)
    draw = ImageDraw.Draw(image)

    font = ImageFont.truetype('tw-cen-mt-6.ttf', size=150)
    (x, y) = (200,875)
    color = 'rgb(7,75,114)'
    draw.text((x, y), name, fill=color, font=font)
    filename = token + '.pdf'
    image = image.convert('RGB')
    image.save(filename)

    filename = token + '.jpeg'
    image = image.convert('RGB')
    image.save(filename)


image = sys.argv[0]
name = sys.argv[1]
title = sys.argv[2]
token = sys.argv[3]
issuer = sys.argv[4]

generateCert(image, name, title, token, issuer)
