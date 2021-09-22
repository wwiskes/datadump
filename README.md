# datadump
This is just a place for me to toss files. It's actually exposed as a webpage, so that files web-addresses can be directly read into scripts. This is pretty cool for centralizing all my key files that I use over and over again, and keep myself from having to duplicate the same JSON into different projects again and again.

Interesting enough github can actually be used like this as a non-relational nosql file database. In a team setting this can be really powerful in that if a person says "X" JSON is the golden standard, then you know everyones on the same page. From an enterprise standing thats pretty cool. Although pre-filtering isn't possible, of course.

Rstudio example:

library(sf)

counties <- st_read("https://wwiskes.github.io/datadump/bayarea.geojson") %>% st_transform(crs = 4326)
