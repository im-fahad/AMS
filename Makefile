#some of handy shortcuts you can use
install:
	@cp .env-example .env;docker-compose build;docker-compose up -d;
cons:
	@docker-compose ps
shell:
	@echo "loggin into container"
	@docker-compose exec application bash
restart:
	@docker-compose down --remove-orphans
	@docker-compose up -d --build
start:
	@docker-compose up -d --build
stop:
	@docker-compose down --remove-orphans
npm-i:
	@docker-compose exec node npm install $(pkg) --save
npm-un:
	@docker-compose exec node npm uninstall $(pkg)
node-restart:
	@docker-compose exec node /usr/local/bin/restart.sh;docker-compose restart node;