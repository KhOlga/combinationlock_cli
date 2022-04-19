# PHAR Compiler

## Introduction

The PHAR Compiler is CLI Application provides a simple functionality for compiling PHAR archive based on Symfony's Console Component.

## Installation

Clone this PHAR Compiler on your computer.

In the root directory off PHAR Compiler execute in command line `php bin/compiler compile:phar`.
On the question 'Should I compile .phar for you?' type 'yes'.
It will compile 'combinationlock.phar' file.
Now you may use combinationlock.phar CLI application as an example PHAR archive.

## About CombinationLock CLI Application

### Introduction

The CombinationLock CLI Application provides a simple functionality for generating a value of the lock.

### Usage

Note: You should have PHP installed on your computer.

Then clone the CombinationLock CLI Application on your machine and execute in command line `php combinationlock.phar <length_of_lock>`, where <length_of_lock> is the length of the lock (a number of characters in the lock).

*For example, you need a value that has a length of 7 characters. You can execute in command line `php combinationlock.phar 7`.*