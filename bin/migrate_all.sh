#!/bin/bash

/opt/lampp/bin/mysql -u root < $(../migrations/)
