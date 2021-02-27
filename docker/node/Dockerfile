# Image
FROM node:12.4-alpine

# Set up work directory
WORKDIR /var/www/client

ARG SERVER_ENVIRONMENT
ENV HOST 0.0.0.0
ENV E_SERVER=$SERVER_ENVIRONMENT

COPY restart.sh /usr/local/bin
RUN chmod +x /usr/local/bin/restart.sh

EXPOSE 80

#CMD ["sh", "-c", "npm install -g -eslint && npm run dev"]

#CMD if [ "x$E_SERVER" = "local" ] ; then echo Argument not provided ; else echo Argument is $E_SERVER ; fi

CMD if [ "$E_SERVER" = "local" ]; then \
    npm run dev; \
  else \
    export PATH=node_modules/.bin:$PATH && \
#    npm install && \
    nuxt build && \
    nuxt start; \
  fi
#RUN if [ "$SERVER_NAME" = "local" ]; then " && npm run dev" ; else "export PATH=node_modules/.bin:$PATH && npm install && nuxt build && nuxt start"; fi
#CMD ["sh", "-c","export PATH=node_modules/.bin:$PATH && npm install --only=production && nuxt build && nuxt start"]
