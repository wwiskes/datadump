from urllib.request import  urlopen
response = urlopen("https://birdmaps.alwaysdata.net/heythere.php")
print(response.read())
