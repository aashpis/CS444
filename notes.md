# 1 - Intro to Compsec

## Security Ideals

- only see what we should be able to
- can't modify what we should not be able to
- can verfiy what we are seeing is from entity we expect
- can access things that should be available
- protected from bad actors, failures, negligence, misuse

## CIA Triad (Guiding Principles)

1. Confidentiality
   - only authorized user can view data
   - user authorization and authentication
2. Inegrity
   - no unauthorized modificiations
   - ensure data is from source or sender
3. Availability
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

Security of cipher is based on key secrecy, not algorithms

Need to be able to generate random bits securely for key gen
-psuedo-random number generator (PRNG)

**Forward Secrecy** - if long term exposed, previous comms should not also be exposed

**Computational Security** - use algos + key sizes that ensure decryption is not feasible (time or computationally)

**Key Size**

key size != security

256 bit security usually enough

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

Algorithm - use **AES(Advanced Encryption Standard)**
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

uses 2 keys - **Public** and **Private** - generate public from private

Slower than symmetric, but allows others to send you messages using your public key

Must keep private key safe

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

used for signatures and "store" password (not safe to store in plain text)

Algorithm: **SHA-2** - family of algo, can use SHA-256 or SHA-512

* Don't use any other algos

### Digital Signatures 

essentially hash with asym encryption

generate hash from message then sign it with your private key.

used non-repudiation - guarentess who sent message

Authenticate message

### Password Storage

**NEVER** store passwords in the clear

**Minimum:** Hash + Salt

#### Popular Algorithms

* Argon2Id - should use
* PBKDF2 - should use, FIPS-140 compliant, recommended by NIST
* Bcrypt - don't use
