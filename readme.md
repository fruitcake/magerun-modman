# Magerun Modman Command

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/fruitcakestudio/magerun-modman/master.svg?style=flat-square)](https://travis-ci.org/fruitcakestudio/magerun-modman)

## Installation

1. Create ~/.n98-magerun/modules/ (if it doesn't exist yet).

```shell
mkdir -p ~/.n98-magerun/modules/
```

2. Clone this repo in your modules folder.

```shell
cd ~/.n98-magerun/modules/
git clone https://github.com/fruitcakestudio/magerun-modman.git
```

3. It should be installed. Check if the `modman:generate` shows up.

See other options here: [http://magerun.net/introducting-the-new-n98-magerun-module-system/](http://magerun.net/introducting-the-new-n98-magerun-module-system/)

## Generate command

Use this file to generate a modman file, based on the current directory.

```shell
$ magerun modman:generate [-d|--dir[="..."]] [-r|--raw]
```

Examples:

```shell
$ magerun modman:generate              # Will show modman script for current directory
$ magerun modman:generate > modman     # Will write output to 'modman' file in current directory
$ magerun modman:generate --dir="src"  # Will scan the 'src' dir, as module root
$ magerun modman:generate --raw        # Doesn't combine/rewrite the paths, but lists all files
```

> Note: If the paths aren't correctly rewritten, you can try the `--raw` flag. This will create a line for each unique file.
