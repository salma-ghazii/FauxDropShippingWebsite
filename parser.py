import mysql.connector
import sys
import xml.dom.minidom

document = xml.dom.minidom.parse(sys.argv[1])
name=""
desc=""
price=0
image=""
rating=""
cat=""

h1Elems = document.getElementsByTagName('h1')
titleElems = document.getElementsByTagName('title')
divElems = document.getElementsByTagName('div')
spanElems = document.getElementsByTagName('span')
buttonElems = document.getElementsByTagName('button')
metaElems = document.getElementsByTagName('meta')


if sys.argv[2] == "dillards":

    name = titleElems[0].firstChild.nodeValue[:-12]
    for elem in h1Elems:
    	if elem.getAttribute("class") == "product__title m-b-10":
            name=elem.getElementsByTagName("span")[1].firstChild.nodeValue
            
    for elem in divElems:
        if elem.getAttribute("class") == "col-sm-12 product-description":
            desc="Features of this product: "
            i=0
            for item in elem.getElementsByTagName('li'):
            	if item.firstChild.nodeValue:
                    i=1
                    desc+=item.firstChild.nodeValue + ", "
            if(i):
                desc = desc[:-2]
            else:
                desc = elem.getElementsByTagName('div')[2].firstChild.nodeValue
                

            
    for elem in spanElems:

        if elem.getAttribute("class") == "price":
            price = elem.firstChild.nodeValue[1:]
            #print(price)
    for elem in metaElems:

        if elem.getAttribute("property") == "og:image":
            image = elem.getAttribute("content")

    for elem in divElems:

        if elem.getAttribute("id") == "pr-reviewsnippet":
            #print(elem.getElementsByTagName("span")[0].firstChild.nodeValue)
            rating = elem.getElementsByTagName("span")[0].firstChild.nodeValue[6:-6]

else:
    for elem in h1Elems:

        if elem.getAttribute("class") == "ProductName":

            name = elem.firstChild.nodeValue

    for elem in divElems:

        if elem.getAttribute("class") == "VCSProductLongDescription__Html":

            p = elem.getElementsByTagName('p')[0] 

            #print(p.firstChild.nodeValue)

            break

    for elem in spanElems:

        if elem.getAttribute("class") == "ProductShortDescription":

            desc = elem.firstChild.nodeValue



    for elem in divElems:

        if elem.getAttribute("class") == "ProductPrice":

            price = elem.getElementsByTagName('span')[0].firstChild.nodeValue[1:]



    for elem in metaElems:

        if elem.getAttribute("property") == "og:image":

            image = elem.getAttribute("content")



    for elem in divElems:

        if(elem.getAttribute("class") == "ProductRating"):

            rating = elem.getElementsByTagName('div')[0].getAttribute('title')





#print("{}\n{}\n{}\n{}\n{}".format(name, desc, price, image, rating))


def insertProduct(cursor, n, d, p, u, r, i, c, co):
    query = 'INSERT INTO products(name,description ,price, image, rating, i, category, company) VALUES (%s,%s,%s, %s, %s, %s, %s, %s)'
    cursor.execute(query, (n,d, p, u, r, i, c, co))

def updateProduct(cursor, n, d, p, u, r, i, c, co):
    query = 'UPDATE products SET name=%s,description=%s,price=%s, image=%s, rating=%s, i=%s, category=%s, company=%s WHERE i=%s and company=%s'
    # print(query)
    cursor.execute(query, (n,d, p, u, r, i, c, co, i, co))



#def insertDillards(cursor, n, d, p, u, r, i, c):
    #query = 'INSERT INTO dillardsProducts(name,description ,price, image, rating, i, category, company) VALUES (%s,%s,%s, %s, %s, %s, %s)'
    #cursor.execute(query, (n, d,p, u, r, i, c, co))
    


try:
    cnx = mysql.connector.connect(host='localhost', user='root', password='abc', database='website')
    cursor = cnx.cursor()
    index=int(sys.argv[3])
    if index<5:
    	cat="men"
    if index>4 and index<10:
    	cat="women"
    if index>9 and index<15:
    	cat="home"
    if index>14 and index<20:
    	cat="accessories"
    if index>19:
    	cat="beauty"
	
    #if sys.argv[2] == "dillards":
    	#insertDillards(cursor, name, desc, price, image, rating, index, cat, "dillards")
    	#cnx.commit()
    #else:
    query='Select Count(*) FROM products WHERE i="{}" and company="{}"'.format(index, sys.argv[2])
    cursor.execute(query)
    exists=cursor.fetchone()
    # print("exists= " + str(exists[0]))
    if exists[0]:
        updateProduct(cursor, name, desc, price, image, rating, index, cat, sys.argv[2])
        cnx.commit()
    else:
        insertProduct(cursor, name, desc, price, image, rating, index, cat, sys.argv[2])
        cnx.commit()

    	

    #update(cursor)
    #cnx.commit()

    cursor.close()
except mysql.connector.Error as err:
    print(err)
finally:
    try:
        cnx
    except NameError:
        pass
    else:
        cnx.close()


