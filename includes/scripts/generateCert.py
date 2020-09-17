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


def wordsbyspaces(phrase):
    words = phrase.split(" ")
    count = [len(word) for word in words]

    return count


def getindex(lenlist, minval):
    value = 0
    for i in range(len(lenlist)):
        if i + 1 < len(lenlist):
            value += lenlist[i]
            if value  + lenlist[i+1] > minval:
                return i
        else:
            return i


line = sys.argv[1:]

imagename, username, title, token, issuerName, idcert = getparam(line)
path = os.path.join(os.getcwd(), "includes/scripts/certificates/")

if imagename == '001.png':
    image = Image.open(path+'001.png')
    back_im = image.copy()
    qr = qrcode.QRCode(version=1,
                       error_correction=qrcode.constants.ERROR_CORRECT_L,
                       box_size=10,
                       border=4,)
    qr.add_data('www.certdepo.com/show-certificate.php?id='+idcert)
    qr.make(fit=True)
    qrimg = qr.make_image(fill_color="black", back_color="#f2f2f2")

    back_im.paste(qrimg, (0, 0))
    draw = ImageDraw.Draw(back_im)

    fontpath = '/var/www/certdepo/includes/scripts/tw-cen-mt-6.ttf'

    if len(issuerName) < 25:
        font = ImageFont.truetype(fontpath, size=200)
        draw.text((200, 500), issuerName, fill='rgb(0,0,0)', font=font)
    else:
        font = ImageFont.truetype(fontpath, size=200)
        count = wordsbyspaces(issuerName)
        namesplit = issuerName.split(" ")
        mindex = getindex(count, 28)

        n1 = " ".join(namesplit[:mindex])
        n2 = " ".join(namesplit[mindex:])
        draw.text((200, 375), n1, fill='rgb(0,0,0)', font=font)
        draw.text((200, 575), n2, fill='rgb(0,0,0)', font=font)

    color = 'rgb(7,75,114)'

    if len(username) < 30:
        draw.text((200, 950), username, fill=color, font=font)
        font = ImageFont.truetype(fontpath, size=200)
    else:
        font = ImageFont.truetype(fontpath, size=150)
        count = wordsbyspaces(username)
        namesplit = username.split(" ")
        mindex = getindex(count,32)

        n1 = " ".join(namesplit[:mindex])
        n2 = " ".join(namesplit[mindex:])
        draw.text((200, 900), n1, fill=color, font=font)
        draw.text((200, 1080), n2, fill=color, font=font)
    
    if len(title) < 28:
        draw.text((200, 1500), title, fill=color, font=font)
        font = ImageFont.truetype(fontpath, size=200)
    else:
        font = ImageFont.truetype(fontpath, size=150)
        count = wordsbyspaces(title)
        print(count)
        namesplit = title.split(" ")
        mindex = getindex(count,55)

        n1 = " ".join(namesplit[:mindex])
        n2 = " ".join(namesplit[mindex:])
        draw.text((200, 1450), n1, fill=color, font=font)
        draw.text((200, 1600), n2, fill=color, font=font)

    #draw.text((200, 1500), title, fill=color, font=font)
    font = ImageFont.truetype(fontpath, size=155)
    draw.text((210, 2125), token, fill=color, font=font)

    filename = 'Cert' + str(idcert) + '.png'

    back_im = back_im.convert('RGB')
    #raise Exception(os.getcwd())
    back_im.save("includes/scripts/certificates/temp/"+filename, 'PNG')
