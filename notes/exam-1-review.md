# Exam 1 Review

review scenarios

implementation of password manager

know common port numbers - https, ssh, ftp, http

## Linux Cmds

know what you can do with openssl

navigate system, adjust permissions, edit files,

know some config cmds from hardening assignemtn

know chmod

## Crypto

know which algos to use, key size

sha-2, sha-256

what encrpytion is vul to quantum? asymetric

forward secrecy - DH for key excahgne of sesion key.

private key can derive public but not vice-versa

## Discussion

hasing is encryption.

http - port 80

## 2/17

nmap - sec team needs to use it to secure ports

UFW not hardware firewall - hardware firewall is stronger, UFW is just good for server, least priveledge - system engineers shouldnt be doing this config. what it gets misconfigured.

SSH login - block that IP, use SSH keys auth, not passwords, update ssh host allow to make sure it only allows intended. use VPN

---

# Exam Topics:

# Exam #1 Topics

> Format will be a mix of TF, multiple choice, fill in the blank, short answer.

## Intro

Know the difference between Confidentiality, Integrity, and Availability (CIA), and how they can be applied in a scenario

What is the difference between a Threat and a Vulnerability and an Asset

What is the type of Virtual Machine we are using in class? What is the OS?

Know basic Linux commands that we used in class

## Cryptography

Understand the differences between symmetric and asymmetric encryption

> sym: single key for enc/dec
>
> asym: public key for enc, private key for dec and creating public keys

When would we use one over the other?

> Sym for when we have secure connection with a validated users

Why have both? How can we use both?

> sym is quicker but more vulnerable, asym is more secure, but slower. We can use asymmetric to securely exchange a sym key.

Understand the basic process of encrypting and decrypting

> generate a key, share key to encrpt and decrpyt. need to encode bits as b64 to easily share.
>
> asymmetrical: create private key, use to create public key. Pub key is used to encrpyt messages
>
> pseudo-random number generator (PRNG) to generate a random number for bits

Understand what role a salt plays in encryption and decryption and how it is stored

> Salt is a unique random string bits you add to data to help randomize the output of a hashing algorithms. It is stored with what ever is being hashed. It helps prevent rainbow table atttacks.

Understand what role encoding has if it is not encryption

> It allows to send and store encrpyted data in a machine friendly format. Encrpyted data just appears as random bits.

Understand which algorithms are used, how they are used, and which ones should not be used

> AES: symmteric encrpytion
>
> PBKDF: used to derive a key based on a password
>
> SHA-2 - Family of Hashing algorithms, can use SHA-256 or SHA-512
>
> DH - for exchanging session key

How: What is PBDKF2 used for? How is it different than AES?

> PBDKF2 derives a key from a password.
>
> AES is the encrpytion algorthim. we can use PBDKF2 to derive a key to use in cipher using AES

Not: Should we use DES and ECB?

> No, these are not safe and easy to crack.
>
> DES - key too small
>
> ECB - breaks messages into blocks and uses the same key to encrpyt each one so same input produces same output

Understand what hashing is and how do we use it. How can hash tables be attacked?

> one way encrpytion. input has some random string of char as output
>
> rainbow table attack: pre-calc the hashes of most common passwords and see what pre-calculated hashes match the target hash table

Understand what a digital signature is and why is it used, how to create it, how to verify it

> A digital signature allows us to authenticate that some data wasn't tampered with and it is from the intended source.
>
> A digital signature is an encrypted hash. The hash is made from the contents of data (like a message, certificate, or some file) then the creator encrypts with a private key.
>
> Anyone can then use the public key to decrpyt the hash, then calculate the hash themselves with the data.
> If they can properly decrypt the signature and their hash matches it, then the data is verified.

Why do we use Base64 encoding if it is not encryption?

> Encrypted data is just raw bytes and can't be reliable stored or sent. base64 allows us to encode these raw bytes into chars that can be handled by code and protocols.

Understand how the password manager was implemented, key components of the assignment

Which cryptography is more vulnerable to quantum computing?

> Asymmetrical

## Certificates

Understand what a CA is and what a Root CA is. What is an intermediate CA?

> CA: Certificate Authority. Issue and maintain certificates. Needs to be trusted at OS level
>
> Root CA: self signed certificate. Used to gen other certificates. Stored in CA
>
> Intermediate CA: used to gen certificates rather than root so it's easier to replace if compromised

Understand how certificates are used with TLS

> Client sends hello to server
>
> Server sends hello (cert and cipher algo)
>
> Client can verifiy cert then initiate key exchange

What are the two primary functions of a certificate?

> Verifiy Identify, share public keys

What is the Let's Encrypt service, what does it offer?

> It's a certificate authority - it can create and sign a TLS certificate for a website

What type of encryption is used with TLS and in which stage?

> Ellipitcal Curve Diffie Hellman - after hello message are exchanged and client has confirmed website and certificate are valid

Understand basic of TLS handshake. What is trying to be accomplished?

> Verification of Identiy of the client and server. Key exchange to create session keys for secure communcation with forward privacy

Why would someone receive a warning when they visit a website? What could cause it?

> a certificate expired, the domain of the site and in the certificate do not match. Certificate is revoked. Website is using HTTP not HTTPS.

## Network Security

Understand how protocols can be attacked (e.g. TCP SYN, ARP, DNS, etc)

> DNS you can do a flood attack where you send a huge volume of DNS request and then route responses to target IP
>
> TCP - DoS attacks, continous send requests where the server can't actually provide any service
>
> SYN flood - sends syn request but never return ack and keep connections half-open

Understand basics of TCP and IP and the responsibilities of each protocol. How IP and Port are used together?

> IP is the routing, finds the endpoint, ports determine application or service and the protocol (HTTP, SSH)

Understand how to define a network zone for a network diagram, what role firewalls play in creating a zone

> create firewalls between zones (DMZ, database, employee access, application)

Understand differences in firewalls such as packet filter and stateful

> packet filter - examines packets destination - IP, port, protocol. easy to implement, less secure
>
> stateful - examines and tracks connection. uses state table to keep track of connection
>
> deep packet analysis: analyzes content along with IP and port. privacy issues you need to read packet contents
>

Understand basic ways of scanning a network and finding information about a network using whois, nmap, etc

> nmap -sV `<host>` - find ports and SW versions being run
>
> whois - who owns domain name
>
> - `ping hostname|ip` - ping host/ip address
> - `tcptraceroute hostname | ip` - find route on network
> - `tracepath hostname | ip` - find route pn network
> - `nc host port` - can connect to service. nc = netcat

Understand what service DNS provides and how it can also be attacked

> DNS manages the mapping of domains to ip address
>
> Attack - Spoof an IP address, ask DNS for any result, then routes it to a target IP address tp DoS them.

Understand ways of verifying an email through email servers and signatures

> Domain Key Identified Mail - use digital signature in header to sign emails that come from a domain
>
> Sender Policy Framework - specify which servers emails are sent from

## Operating System Security

Understand principle of least privilege and how we can apply it in OS security

Understand important of updating packages, regularly checking services, checking logs, etc

How to harden an operating system and core software such as Apache and SSH

How to apply different permissions and their affect on regular files vs directories

How to setup firewall on the OS using ufw

What are the configuration file we would set on an operating system and where are they located on the operating system

What do things like chroot and cgroups provide when it comes to security?

## Malware and Threats

What is a virus and a trojan?

What is spyware and malware?

What is phishing?
