# FizzBuzz Project

![CI](https://github.com/dunglas/symfony-docker/workflows/CI/badge.svg)

## Project Description

This application iterates over all numbers from one to 100. If the number is divisible by 3, it prints Fizz instead of the number. If the number is divisible by 5, it prints Buzz. If the number is divisible by both 3 and 5, it prints FizzBuzz.

## New Features
In the first page you will find a form where you can enter with your own numbers for fizz and buzz and also a the interval of numbers you want to check. The page also has a pagination to make it easier to navigate
through the results.

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --no-cache` to build fresh images
3. Run `docker compose up --pull always -d --wait` to start the project
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)