# oyaoya

A CLI tool written in PHP that compares the number of keys typed in Japanese between the NICOLA layout (a kind of key layout for thumb-shift keyboards) and the QWERTY layout.

## Setup

```sh
# 1. Install MeCab and its dictionary
# See https://taku910.github.io/mecab/#install

# 2. Install PHP8.3
# See https://www.php.net/manual/en/install.php

# 3. Run composer install
composer install
```

## Usage

```sh
$ echo "打鍵数カウント" | ./oyaoya
NICOLA: 7
Romaji: 9
```
