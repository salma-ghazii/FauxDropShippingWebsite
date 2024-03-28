#!/bin/bash
while :
do 
	if ! [ -f tagsoup-1.2.1.jar ]; then
		wget https://repo1.maven.org/maven2/org/ccil/cowan/tagsoup/tagsoup/1.2.1/tagsoup-1.2.1.jar
	fi

	#https://repo1.maven.org/maven2/org/ccil/cowan/tagsoup/tagsoup/1.2.1/tagsoup-1.2.1.jar
	i=0
	while read line
	do
		# echo "index $i of vermont"
		curl $line > web1.html
		java -jar tagsoup-1.2.1.jar --files web1.html
		python3 parser.py web1.xhtml "vermont" $i
		rm web1.xhtml web1.html 
		(( i++ ))

	done < "$1"

	i=0
	while read line
	do
			# echo "index $i of vermont"
			curl $line > web1.html
			java -jar tagsoup-1.2.1.jar --files web1.html
			python3 parser.py web1.xhtml "dillards" $i
		rm web1.xhtml web1.html 
		(( i++ ))

	done < "$2"
	sleep 6h
done

