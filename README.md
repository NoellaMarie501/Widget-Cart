# Acme Widget Co - Basket Pricing System

This is a PHP-based proof of concept for Acme Widget Co's sales system. It implements a basket with product management, dynamic pricing rules, delivery charge calculations, and special offers like **"Buy One Red Widget, Get the Second Half Price"**.

## Features
- Add products to a basket
- Calculate total price with special offers
- Apply dynamic delivery charges
- Unit-tested with PHPUnit
- Docker and docker-compose support for easy setup



## Installation & Setup

### 1. Clone the repository

git clone hhttps://github.com/NoellaMarie501/Widget-Cart.git
cd Widget-Cart

### 2. Build and Start project using makefile

The `Makefile` included in the project simplifies building and starting the application.It provides various targets to build, run, stop, and manage the project, as well as perform development tasks like testing and analysis. Below are the key commands:


## Variables

- **ROOT_DIR**: The root directory of the Makefile.
- **SHELL**: Specifies the shell to be used (`bash` in this case).
- **PROJECT_NAME**: The name of the project (`thrivecart`).
- **ARGS**: Captures additional arguments passed to the Makefile.

## Special Targets

- **.SILENT**: Suppresses the need for `@` to silence commands.
- **.ONESHELL**: Ensures all recipes execute in the same shell.
- **.NOTPARALLEL**: Prevents parallel execution of targets.
- **.EXPORT_ALL_VARIABLES**: Exports all variables to the shell environment.
- **default**: Sets the default target to `help-default`.
- **Makefile**: Skips prerequisite discovery.

## Targets

### Help and Information
- **help-default / help**: Displays usage instructions and available targets.
- **.title**: Prints the project title and version.

### Project Lifecycle
- **build**: Builds the Docker containers for the project.
- **up**: Starts the Docker containers in detached mode.
- **dev**: Builds and starts the project in development mode.
- **stop**: Stops the running Docker containers.
- **status**: Displays the status of the Docker containers.
- **reset**: Stops, removes, rebuilds, and restarts the project.
- **clean**: Stops and removes the Docker containers and orphans.

This will ensure the application is up and running in a Dockerized environment.


### Development and Debugging
- **root**: Opens a shell inside the `thrivecart_app` container as the root user.
- **logs**: Streams the logs of the `thrivecart_app` container.
- **analyse**: Runs static analysis using PHPStan inside the `thrivecart_app` container.
- **test-dev**: Executes PHPUnit tests inside the `thrivecart_app` container.


