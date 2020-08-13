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
if imagename == '001.png':
    image = Image.open("includes\\scripts\\certificates\\001.png")
    back_im = image.copy()

    qr = qrcode.QRCode(version=1,
                   error_correction=qrcode.constants.ERROR_CORRECT_L,
                   box_size=10,
                   border=4,)
    qr.add_data('192.168.100.100/show-certificate.php?id='+idcert)
    qr.make(fit=True)
    qrimg = qr.make_image(fill_color="black", back_color="#f2f2f2")

    back_im.paste(qrimg,(0,0))
    draw = ImageDraw.Draw(back_im)

    font = ImageFont.truetype('tw-cen-mt-6.ttf', size=200)
    draw.text((200, 500), issuerName, fill='rgb(0,0,0)', font=font)
    color = 'rgb(7,75,114)'
    draw.text((200, 900), username, fill=color, font=font)
    font = ImageFont.truetype('tw-cen-mt-6.ttf', size=110)
    draw.text((200, 1350), title, fill=color, font=font)
    draw.text((200, 2000), token, fill=color, font=font)

    filename = 'Certificado_' + token + '.png'

    back_im = back_im.convert('RGB')
    back_im.save('includes\\scripts\\certificate\\temp\\'+filename)
