# Tinson
A great JSON file manager for tinfoil. Install every NSP directly on Switch without using cables.

## Why should I use this?
Well, I don't know why you have to use it. I've developed this because my cat jump on my keyboard every time I'm using my mac. 

So is pretty hard to connect my Switch through USB or leave my Mac opened all the time. From download to installation. 
I've thought on a solution that let's you set directly from anywhere in a second a list of downloads link. After that you can manage your queue directly from Tinfoil. 

So, here it comes: Welcome Tinson!

## Getting started
Tinson is based on PHP and JS. So for working you must have a web server which can process PHP. 

### Prerequisites

 * A web server compatible with PHP
 * FTP or SSH
 * Nothing else

There's a lot of free hosting reseller online so this won't be hard to achieve.

### Installing

1. Clone this repository on your PC (or directly on your webserver if you have SSH access).
2. Upload this cloned folder on your website through FTP (you can use [filezilla](https://filezilla-project.org/) or anything you want).
3. _Optional_ change the folder name for something you like.
4. You're ready to create and manage your NSP list.

If your website is: `example.com` open Tinson looking for `example.com/tinson-master`. If you have changed the folder name change the path based on new folder name.

### How to use

#### Website Step

**At the moment Tinson works only for Google Drive's links.** 

What you need for uploading correctly a link is: 
* Google Drive download ID
* Target NSP name

#### Switch Step

Add to `locations.conf` or to `file browser` on Tinfoil the url to your nearly created json. 

The path is `http://example.com/folder-name/switch.json` 

This step is required only first time, after this Tinfoil will load the `locations.conf` refreshing all the contents on them.   

### Authors

Thanks to the one which gave me the idea.
* My cat (get off that keyboard Minou!)

### Acknowledgments

Thanks to: 
* [tinfoil.io](https://tinfoil.io/) which has released this incredible tool.
* [materializecss](http://materializecss.com)
