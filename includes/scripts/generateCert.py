#!/usr/bin/python3.7
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

line = sys.argv[0]
line = line.split(',')

generateCert(linea[0], linea[1], linea[2], linea[3], linea[4])
