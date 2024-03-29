#!/bin/bash

STRING="アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲンガギグゲゴザジズゼゾダヂヅデドバビブベボパピプペポ"
STRING_5000=$(printf "%s" "${STRING}"{1..5000})

echo ${STRING_5000} | wc 

time echo ${STRING_5000} | ./oyaoya
