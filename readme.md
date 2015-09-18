# Magerun Modman Command

## Installation

1. Create ~/.n98-magerun/modules/ (if it doesn't exist yet).

```shell
mkdir -p ~/.n98-magerun/modules/
```

2. Clone this repo in your modules folder.

```shell
cd ~/.n98-magerun/modules/
git clone git@github.com:fruitcakestudio/magerun-modman.git
```

3. It should be installed. Check if the `modman:generate` shows up.

See other options here: [http://magerun.net/introducting-the-new-n98-magerun-module-system/](http://magerun.net/introducting-the-new-n98-magerun-module-system/)

## Generate command

Use this file to generate a modman file, based on the current directory.

```shell
$ n98-magerun.phar modman:generate [-d|--dir[="..."]]
```

Examples:

```shell
$ n98-magerun.phar modman:generate              # Will show modman script for current directory
$ n98-magerun.phar modman:generate > modman     # Will write output to 'modman' file in current directory
$ n98-magerun.phar modman:generate -d src       # Will scan the 'src' dir, as module root
```
