

# DS (data store)

This is a simple data store intended for prototyping.
It will let you persist JS objects to disk with very little effort in JSON form.

DS is:

* Easy to install
* Easy to use
* Free!

DS is NOT:

* Smart
* Secure
* Scaleable
* Flexible
* Featureful

*** Do not use this in production. ***

## Install

	npm install ds

## Example

	var DS = require("ds").DS

	// if no argument, "./ds.json" is used
	// constructore calls load()
	var ds = new DS("./ds.json")

	ds.one = 1
	ds.a = [1,2,"foo"]
	ds.o = {bar:"baz", qux:42}
	ds.save()		// data (all of it) written to ./ds.json
	ds.clear()		// all data erased

## API

	load(path)		// load JSON data from file into memory
					// if path not provided, path provided to constructor is used
	save(path)		// save JSON data to a specific file
	save()			// save JSON data to same file as last time
	clear()			// clear the in-memory data store


