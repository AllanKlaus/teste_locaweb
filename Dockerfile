FROM eboraas/apache-php
MAINTAINER PAAS EMAIL <allan_klaus@globo.com>

RUN apt-get update && apt-get -y install php5-curl
