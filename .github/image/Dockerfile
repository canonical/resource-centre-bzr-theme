# The wordpress-k8s charm's own image with this theme added.
# The charm keeps any installed theme whose slug is in its `themes` config,
# so deploy this with `juju config wordpress-k8s themes=resource-centre`.
ARG BASE_IMAGE
FROM ${BASE_IMAGE}
COPY theme/ /var/www/html/wp-content/themes/resource-centre/
