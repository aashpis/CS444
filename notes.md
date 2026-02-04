# 1 - Intro to Compsec

## Security Ideals

- only see what we should be able to
- can't modify what we should not be able to
- can verfiy what we are seeing is from entity we expect
- can access things that should be available
- protected from bad actors, failures, negligence, misuse

## CIA Triad (Guiding Principles)

**1. Confidentiality**

- only authorized user can view data
- user authorization and authentication
  **2. Inegrity**
- no unauthorized modificiations
- ensure data is from source or sender
  **3. Availability**
- systems and services are available
- resilient against attacks, failures, compromises

## DATA

**Data at Rest**

stored files, data in database, physical folders/storage

**Data in Motion**

communicated through web, sent via netowrk. radio data (WiFi, Blueooth, NFC, LoRa, etc.)

## Threats, Vulnerabilities, Risks

**Threats**

something that can cause harm to system/services

**Vulnerabilities**

where there is opening for harm.

ex. insecure code, lack of backup, physicial security to data center

**Risks**

possbility of threat happening

### Managing Risks

1. Identify Assets - why do we need to protect?
2. Identify Threats - what can cause harm?
3. Assess Vulnerabilities - which would have high impact
4. Assess Risk - what is impact of the vulnerability? what can we accept?
5. Mitigate Risks - how do we reduct risks?

### Incident Response

1. Preperation - how to respond?
2. Detection & Analysis - how we detect and understand it
3. Containment - ensure damage and effects are contianed and don't spread
4. Eradication - how to remove cause of incident
5. Recovery - how to get back to functionality

## Defense in Depth

Want multiple layers of defense like:

- External network - VPN, logging, pen tests
- Network Perimeter - firewalls, proxies, logging
- Internal Network - IDS, IPS, logging
- Host - Auth, hardening, antivirus, scanning
- Appplication - patching, auditing, pen test
- Data - enrcryption, backups, auth

# Cryptography

## CIA Triad

- **Confidentiality** - only those who should have access, can
- **Integrity** - ensure data has not be modified by others

## Uses

- store secrets
- secure web traffic
- secure auth - proving identities
- digital signatures - prove things have not be modified
- Non repudiation - prove that thing is from person and cannot be denied

## Terms

**Clear Text** - unencrypted text

**Cipher Text** - encrypted text

**Encryption** - process of making clear text into cipher

**Decryption** - process making cipher text into clear

**Key** - what you use to convert clear text to cipher and reverse

**Alogrithm(Cipher)** - steps of the encrpytion

**Encoding** - transforming data into other formats (not encrpytion, ex. base64)

## Principles

### Kerckhoff's Principle

Security of cipher is based on key secrecy, not through obscurity

---

Need to be able to generate random bits securely for key gen

-psuedo-random number generator (PRNG)

**Forward Secrecy** - if long term exposed, previous comms should not also be exposed

**Computational Security** - use algos + key sizes that ensure decryption is not feasible (time or computationally)

### Key Size

**256 bit** security is the standard. less is too weak, more is not need (for now)

key size != security

- 128 bit key = 128 bit sec
- 4096 RSA != 4096 bits security

**keylength.com -** algo and key guidelines

### Implementation Matters

If you don't use these tools correctly, it does not matter

#### Example

> A developer on your team decides to use PBKDF2. For the iteration count, they remember that you told them to use 600,000, so they are making sure that they use that.
> They are requiring that the user enters a 16 character password and use the first 16 characters of the password to generate the salt.

Don't use chars from password. same passwords will gen same salt.

> A developer on your team is implementing an E2E (end-to-end) encryption
> solution for people to exchange messages back and forth. Each person
> creates a public/private key pair and on the platform, the public key is provided
> if you want to send the person a message

No forward secrecy, key leaks allow for total decrypt

## Generating & Protecting Keys

### Generating

1. PRNG
2. From Password - key derivation function - ex: PBKDF
3. Key Agreement Protocol - ex. Diffie-Hellman

### Protecting

1. Key Wrapping - encrypt with another key
2. Gen from password
3. Store in Hardware - safest but expensive

## Symmetric Encryption

Same key for en/decryption

Both parties must know key

Algorithm - use **AES(Advanced Encryption Standard) with 256**
-only uses 128, 192, 256 bits only, but 256 is standard and secure enough

### Block vs Stream

**Stream** - encrypt bits one at a time (mostly hardware)

**Block** - take a set number of bits

- CBC (Cipher Block Chaining) - feeds data into next block
- GCM (Galois Counter Mode) - can run in parallel, use when possible

**IV (Initialization Vector)** adds randomness, can store with data in clear

### Downsides

What if you send a message to unknown person? How do you securely get them a key? What if you don't trust them?

Do you create a unique key for each person you communicate with?

## Aysmmetric

**Uses 2 keys** - **Public** and **Private** - generate public from private

Slower than symmetric, but allows others to send you messages using your public key

Must keep private key safe

**Keys need to adhere to min bit size**

### Popular Algorithms

#### RSA (Ron Rivest, Adi Shamir, and Len Adleman)

1024, 2048, 4096 bit keys (2048 bit is min)

#### ECC (Elliptic Curve Cryptography)

Family of algo, doesn't require as large keys

#### DSS (Digital Signature Standard)

Used for digital signatures

#### ECDH (Diffie-Hellman Key Exchange)

For exchanging symmetric key (session key)

### Hashing (Integrity + Confidentiality)

One way encryption, can't reverse it.

**Confidentiality** used for signatures and "store" password (not safe to store in plain text)

Algorithm: **SHA-2** - family of algo, can use SHA-256 or SHA-512

* Don't use any other algos

**Integrity** - we can re-run data through hash fxn to confirm data is untampered

Whatever is encrypted with the Private Key can *only* be decrypted by the corresponding Public Key.

### Digital Signatures

Authenticate message - message is untampered and it's definetly from sender

essentially hash with asym encryption

1, Sender creates message
2, Sender creates hash from message
3. Sender encrypts hash with private key
4. This encrypted hash is the signature
5. Reciever gets message with signature
6. Reciever calculates the hash
7. Reciever decrypts the hash with Sender's public key
8. Reciever confrirms calculated hash is the same decrypted hash

used non-repudiation - guarentess who sent message

### Password Storage

**NEVER** store passwords in the clear

**Minimum:** Hash + Salt, but also use pepper

#### Rainbow Table Attacks

Rainbow Tables: use common password database to pre-calc hash to figure out hashed passwords

Tools to perform attacks:

- RainbowCrack, John the Ripper, Hachcat

#### Adding Randomness for Security:

##### Salt: unique random string added to each password (stored with password)

* You need to use it to derive the key to decrypt data
* usually prepended

##### Pepper: unique random string that all passwords share (kept secret)

##### Initialization Vector(IV): Add randomness to symmetric

#### Popular Algorithms

* **Argon2Id** - should use
* **PBKDF2** - should use, FIPS-140 compliant, recommended by NIST. Can derive key from password. Both hash and key gen
* Bcrypt - don't use

#### PBKDF2 (**Password-Based Key Derivation Function**)

Use a password (like user input) to derive a key for encrpytion.

Add salt to make it more random.

Iteratively hash (**Key Stretching**) the passwords+salt (~600,000) then stores the final hash  (**Derived Key**).

Make it's computationally expensive to crack

## Secure Key Gen and Password Storage

1. Generate salt with secure random number generator (`SecureRandom()`)
2. Convert Salt to bytes
3. Input password
4. Derive a key using password + salt + 600,000 hash iterations
5. Input message
6. Encrypt using key
7. Base64 encode to share
8. Same for decrypt, but decode Base64 encrpyted data before decryption

# Certificates

## Main Uses:

1. Way to share public key
2. Verify Identity - person is who they claim to be

## Attributes

- **X.509** - standard format for cert
- **Public Key** - of the holder
- **Serial Number** - unique ID of cert.
- **Distinguished name (DN)** - Who issued Cert
- **Common Name (CN)** -  domain name of server (ex. "google.com" )
- **Validity** - when cert was issued and expiration date
- **Digital Signature** - Certificate Authorities signature on cert. (encrypted hash)
- **Public key:** anyone can verify CA signature
- **Signature Algortihm** - of digital signature
- Some other optional fields

### Root CA

self-signed cert, installed in OS

### Intermediate CA

Use intermediate cert to generate certs, don't use the root CA
easier to fix compromised intermediate cert then root CA - Root CA compromised means OS update

### Expired Certs

gives warning, don't trust sites with expired certs

## Certificate Authorities (CA)

Signs certificates

Needs to be trusted by OS to trust CA signed certs. Not just anyone can do it

**Let's Encrypt** - nonprofit cert authority (use this one)

Others

- Verisign
- Digicert
- Comodo

### How Certs are Issued

1. Create cert. signing request -
2. Cert Auth:
   1. Verifies ID of requester
   2. Generates a certificate they sign with a private key
   3. Issues the cert
3. Requester installs cert on web server

**Public Key Infrastructure (PKI)** name for what manages all this.

## Certificate Revocation

if private key is compromised or vulnerability is found, cert can be revoked

### Certificate Revocation List (CRL)

Manage by CA to list revoked certificated. Can be pulled or pushed

### Online Certificate Status Checking Protocol (OCSP)

Real time checking for cert validity

## Secure Socket Layer(SSL) & Transport Layer Security (TLS)

Protocol that uses certs to establish secure and confidential connection

Start asymmetric to exchange info to gen key for symmetric

- want to get off asymetric encrypt as soon as possible because it's slow -> use session key
- **forward privacy** - can't decrypt without session key

**Use TLS 1.3 -** SSL is outdated and has vulnerabilities

### How Protocol Works

1. Client sends hello message to Server
2. Server sends hello message - cert and cipher algo
3. Client auths Server's hello then Client sends **pre-master secret** (random byte string) encrypted with Server public key (from cert)
4. Client and Server create session keys using pre-master secret
5. Server and Client send each finished messages to complete exchange

### Diffie-Hellman (Key Agreement Protocol)

establish new pub/priv key pair - can be used for creating session keys

acheives **forward privacy -** compromised cert doesn't allow for decryption

**Elliptical Curve - Diffie-Hellman (ECDHE)** - variant used in TLS 1.3

# Pretty Good Privacy (PGP)

used to encrpyt email & messages

Need to know who is sending, confidential but no auth

# Quantum

Symmetric is thought to be safe - cuts decrypt time by 1/2 but can just double key size

Main threat is to Asymmetric - could possible dervie private key

There are Quantum resistant algorithms

General still safe, but can be threat eventually

# Recaps

Kerkhoff's Principle: depend on key secrey not algo
data at rest - symmetric
data in motion - both asym and sym
why have pub key - to securely get key
hash - for verification, pw storage
why encrypt hash with private key - digital signature, verify data was not modified.

3 ways to gen key:

- Password (PBKDF2)
- Secure random num gen
- from a private key  (Diffiehellman)

OWASP cheat cheat

# Network Security - 02-03-2026

**Network:** some group of communicating computers or hosts

**Internet:** Network of Networks

* made of standards (protocols)
* addressing
* communication
* created by DARPA to control nukes/military comms

## Parts/Layers

### Open Systems Interconnection (OSI)

model on how to divide communication responsibilities

1. **Application**
2. Presentation
3. Session
4. **Transport**
5. **Network**
6. **Datalink**
7. Physical

## Packet

app data is segemented into parts to transmit on network

packets get routed to destination

add header info on each layer

- **Transport Layer -** sequence numbers, flow control, etc
- **Network Layer** - source and destination IP
- **Datalink Layer** - source and destination MAC address

## Network Layer

focus on data routing from one end to another

Routing requires addresses to exist

**IP:** Most well known protocol

### Internet Protocol (IP)

focuses on delivery from source to destination - one IP address to another

### IP Addresses

**Each connected device to Internet must have unique IP**

**Private Addresses:**
• 10.0.0.10 → 10.255.255.255
• 172.16.0.0 → 172.31.255.255
• 192.168.0.0 → 192.168.255.255

**Classes - Determined by first byte of IP address**
• A: 0-126 - Very large networks
• B: 128-191 - Large corporations and government networks
• C: 192-223 - Very common group, includes ISPs
• D: 224-247 - Reserved for multicasting
• E: 248-255 - Experimental use

**Subnets** - divide network into sub networks

#### IPv4

32 bit enough for ~4 Billion addresses

#### IPv6

128 bit

### Network Address Translation (NAT)

best way to protect your network

private IPs are routed through router so only public router IP is exposed and comm with internet

## Transport Layer

ensuring packets get from one point to another

Protocols: TCP and UDP

### Transport Connection Protocol (TCP)

One Sender, One reciever

Package Acknoledgement -  acknowledges when packets are received

uses a "handshakes" to connect

#### Flow Controlled

* Sender won’t overwhelm receiver
* reciever lets sender how much data it can recieve

#### Congestion Control

End systems sending too much, core network can't keep up

Sender uses **Congestion window** with 3 principles:

* Loss Segment = congestion , decrease rate
* Ack Segment = good network, increase rate
* Probe network to adjust flow when needed

#### Connection Setup

1. Client sends server TCP SYN segment
2. No data, sends random sequence number
3. Server responds with SYN ACK segment
4. Still no data, sends random sequence number
5. Client sends ACK (no more SYN) and optionally sends data

#### Connection Teardown

• When client is done, it sends a FIN segment
• Server receives FIN, replies with ACK. It puts connection in closing state, then sends FIN.
• Client receives FIN, replies with ACK
• Goes into TIME_WAIT
• Server receives ACK, connection closed

#### Attacking TCP - Denial of Service (DOS)

Attack a host/service with requests/responses to exhaust server resources

**Distributed Denial of Service (DDOS)**

- DOS by distributed network

#### SYN Flood Attack

Send multiple requests (SYN Packet) to server with spoofed IPs - leaves open half-open connections

### User Datagram Protocol (UDP)

lightweight, "closer" to network layer

less overhead - good for less important info

just send and hope for the best

#### Attacking Server with UDP + IP Protocol

DDoS by spoofing IP address

### TCP vs UDP

**TCP**

* reliable connections with congestion control
* not great for multimedia

**UDP**

* light weight, no handshakes
* send and hope for the best

## Ports

IP determines endpoint, **Port** determines application or service 

* In vs out going traffic
* protocol (HTTP vs FTP vs SSH etc.)

each open port is opportunity for attack

cmd **nmap** - scan for open ports

## Domain Network Services (DNS)

naming system for computers, services, whatever that is connected to internet - "phonebook" of internet

maps IP addresses and other data to Domain Names. easier to know domain name over IP address

Request made over UDP
