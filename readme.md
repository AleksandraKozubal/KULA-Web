## Kebabowe Uniwersum LegnicA

### Local development
```
cp .env.example .env
make init
make dev
```
Application will be running under [localhost:63251](localhost:63251) and [http://kula-web.localhost/](http://kula-web.localhost/) in Blumilk traefik environment. If you don't have a Blumilk traefik environment set up yet, follow the instructions from this [repository](https://github.com/blumilksoftware/environment).

#### Commands
Before running any of the commands below, you must run shell:
```
make shell
```

| Command                 | Task                                        |
|:------------------------|:--------------------------------------------|
| `composer <command>`    | Composer                                    |
| `composer test`         | Runs backend tests                          |
| `composer analyse`      | Runs Larastan analyse for backend files     |
| `composer cs`           | Lints backend files                         |
| `composer csf`          | Lints and fixes backend files               |
| `php artisan <command>` | Artisan commands                            |
| `npm run dev`           | Compiles and hot-reloads for development    |
| `npm run build`         | Compiles and minifies for production        |
| `npm run lint`          | Lints frontend files                        |
| `npm run lintf`         | Lints and fixes frontend files              |
| `npm run tsc`           | Runs TypeScript checker                     |


#### Containers

| service    | container name            | default host port               |
|:-----------|:--------------------------|:--------------------------------|
| `app`      | `kula-web-app-dev`     | [63251](http://localhost:63251) |
| `database` | `kula-web-db-dev`      | 63253                           |
| `redis`    | `kula-web-redis-dev`   | 63252                           |
| `mailpit`  | `kula-web-mailpit-dev` | 63254                           |

#### Production

Remember to **secure your firewall** for initialization of the app, because during first run it will ask to make an **admin account**!

#### API

To see all available endpoints see the route **/api-docs**.
If you are more interested in raw data see the route **/api-docs/raw**
