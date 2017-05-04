#!/bin/bash

source config/environment.sh

echo "Lisätään testidata..."

ssh samuvait@users.cs.helsinki.fi "
cd htdocs/tsohasov/sql
psql < add_test_data.sql
exit"

echo "Valmis!"
