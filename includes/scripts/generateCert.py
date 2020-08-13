#!/usr/bin/env python3
from PIL import Image, ImageDraw, ImageFont
import string
import sys


def generateCert(image, name, title, token, issuer):
    im = Image.open(image)
    draw = ImageDraw.Draw(image)

    font = ImageFont.truetype('SecularOne-Regular.ttf', size=200)
    (x, y) = (800, 900)
    color = 'rgb(255,195,0)'
    draw.text((x, y), name, fill=color, font=font)
    filename = token + '.pdf'
    image = image.convert('RGB')
    image.save(filename)
    filename = token + '.jpeg'
    image = image.convert('RGB')
    image.save(filename)


if __name__ == "__main__":
    image = sys.argv[0]
    name = sys.argv[1]
    title = sys.argv[2]
    token = sys.argv[3]
    issuer = sys.argv[4]

    generateCert(image, name, title, token, issuer)
