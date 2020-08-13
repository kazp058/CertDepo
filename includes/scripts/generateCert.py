#!/usr/bin/python3.7

#from PIL import Image, ImageDraw, ImageFont
import string
import sys
    #image = Image.open("certificados/" + image)
    #draw = ImageDraw.Draw(image)

    #font = ImageFont.truetype('tw-cen-mt-6.ttf', size=150)
    #(x, y) = (200,875)
    #color = 'rgb(7,75,114)'
    #draw.text((x, y), name, fill=color, font=font)
    #filename = token + '.pdf'
    #image = image.convert('RGB')
    #image.save(filename)

    #filename = token + '.jpeg'
    #image = image.convert('RGB')
    #image.save(filename)

def getparam(line):
    imagename = line[1]
    username = " ".join(line[3:line.index('-t')])
    title = " ".join(line[line.index('-t') + 1:line.index('-k')])
    token = line[line.index('-k')+1]
    issuerName = " ".join(line[line.index('-i') + 1 :])
    return imagename, username, title, token, issuerName
line = sys.argv[1:]

print(getparam(line))
#generateCert(line[0], line[1], line[2], line[3], line[4])
