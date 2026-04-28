# Notes from Exam 2 to Final

# 4/14/2026

# Forensics

evidence may need to be gathered and examined carefully.

Ensure it's not tamepred with like criminal investigation

- both intentional or accidental
- tools can create copies/images of hd, ssd, USB drives, ect.
  - linux dd utility

Kali Linux - can use tools and packages independent of the distro

# Process

1. secure evidence
2. chain of custody
3. investigation

## Secure Evidence

- get it offline so it can't be tampered with
- only authorized authorities get this

## Chain of Custody

if custody can't be determined, evidence may be useless

- document anyone who accesses the evidence
- document what was done with the evidence
- document where it was stored
- doucment every location and who interacted with evidence

## Investigation

- Create a trail - Document everything in investigation
- Document stes to create image of what is being investigated
- document tools used
- document tests peformed
- document anything suspicious and what steps led to discovery

# Popular Forensics Tools

- Autopsy - browse and find data on filesystem
- Foremost - find "deleted" files
- Dumpzilla - show browsing history
- Bulk Extractor - Will look for credit cards, email address, GPS coordinates from
  images, and more from an image

# In class notes

if you find shell you cna find etc/passwd

echo $SHELL

cat .bash_history

you can view logs for login, installing, user groups and sudo groups

look at configs etc/systemd to see whats running

check cron and .bashrc for timebombs

`crontab -l` and `crontab -e`

ls -ltr

# 4/16/26

# IoT - Internet of Things

Almost all devices are connected to the internet

How do you secure devices and keep them updated

class focus - non-traditional device

## Challenges

Challenge to update

- limited write space
- how to perform update (securely)
- update certs not just SW
- limited physical access
- how to verify update from trusted source

Limited knowledge - devs make space

Less resources - less secure implementations of RNG and encryption

## OWASP Top 10 IoT

Start with OWASP Top 10 for IoT

### 1. Weak, Guessable, Hardcorded Password

Users should be required to change default password

default passwords should be unique for each user

### 2. Insecure Network Services

comms over HTTP not HTTPS

Data exposed over unencrypted channel

Cert Authority expries -> How do you update CA when its installed on device?

### 3. Insecure Ecosystem Interfaces

Configure router via web app

What if you could update a device without authentication or authorization

## Other 10

### 4. Lack of Secure Update Mechanism

validation failure on update, unable to update device

### 5. Use of Insecure or Outdated Components

both hardware and software

### 6. Insufficient Privacy Protection

devices store/transmit data without proper user protections

### 7. Insecure Data Transfer and Storage

 Lack of confidentiality in storing or transferring data

### 8. Lack of Device Management

managing, provision, decomissioning active devices

### 9. Insecure Default Settings

devices are insecure by default or user can't take action to secure their devices

### 10. Lack of Physical Hardening

devices can take control of devices with physical access, like an SD card

## Random Number Generators for IoT

many devices use insecure RNG

Can affect secure connections where keys are generated

# Mobile

Dominant Platform

Contains tons of personal and sensitive data, not guarenteed to be stored securely

data is monetized

## OWASP Top 10 Mobile

### 1. Improper Credential Usage

hardcoded credentials within the application

  storing w/o encryption

easy to discover

can unpack APKs or explore iOS file system

Utilize best practices provided by mobile OS

- iOS - keychain
- Android - Credential Manager

### 2. Inadequate Supply Chain Sec

includeds comprimised or malicious libraries

Android use gradle or maven - more reliable than pulling repos

iOS uses Swift Package Manager

### 3. Insecure Authentication/Authorization

most apps use a backend services - can examine with Burp Suite

service may think the call is coming from mobile client when it can come from replay attack

other attacks can bypass authentication or authorization in the app itself

- can escalte privilege
- change config to say you "purchases" an add-on

do auth on both sides

## Other 10

### 4. Insufficient Input/Output Validation

Similar to web

### 5. Insecure Communication

Similar to IoT! This is easier to fix with regular updates

### 6. Inadequate Privacy Controls

Similar to IoT

### 7. Insufficient Binary Protections

attacking the application binary by finding keys or repackaging it and distributing it

### 8. Lack of Device Management

Includes provisioning, decommissioning devices

### 9. Security Misconfiguration

Insecure default settings, default passwords,

unprotected storage of keys or username/passwords

### 10.Insufficient Cryptography

Using weak encryption, no salts, small keys

## Device and App Protections

### Data Protection

Device level encryption where separate keys are used to encrypt files, separate keys are used to encrypt those keys, and so on

A key encrypts a high level key or a set of keys using the user's passcode or biometrics

### Secure Enclave

use true RNG

secure boot

AES-256 encryption

### Trusted App Stores and App Signing

Apps are reviewed and signed by app store provider

Device checks signature before installing

### App Level Encryption

extra layer protection, secures data in app

### Certificate Pinning

install cert locally in application to prevent MITM attack

# Class Notes 4/23/2026

symmetric is quantum safe, aysmmetric is not

exam

- Know some code (PHP, injection)
- know main top 10 points
- know specific files from OS hardening/config assignment
- review password manager and server

OS hardening

- sshd_config - how you ssh into server (key, password), how many tries you get, how many sessions
- access.conf - specificy accounts that can remote in
- host.allow - IPs that can shh in

Password hardening
