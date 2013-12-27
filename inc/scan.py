##############################################################################
##    Author: Adam Phillips
##
##    test.py
##
##    This script will scan the network based on input and
##    attempt to determine if the host is pingable, the DNS name
##    if applicable, and/or the SNMP system name.
##
##    Usage:  test.py -n [network] -x [exclusion list] -s [Comm list]
##
##        Example:
##              test.py -n 192.168.1.0/24 -x 192.168.1.50,192.168.1.60-192.168.1.65 -s public,private
##
##              -n:  The network address in /n notation to be scanned
##              -x:  Addresses to be excluded from the scan seperated by ','
##              -s:  List of SNMP communities seperated by ','
##
##
##
##      REQUIRED MODULES:
##              LIBSNMP-PYTHON
##              PYTHON-IPADDR
##
##############################################################################

import argparse
import netsnmp
import socket
import ipaddr
import subprocess, sys, threading
from Queue import Queue

#Main Thread Class
class scan (threading.Thread):
	def __init__(self,ip,comm):
		threading.Thread.__init__(self)
		self.ip = str(ip)
		self.comm = comm
	def run(self):
		queue.get(True)
		self.status = pingMe(self.ip)
		self.fqdn = getName(self.ip)
		if not self.fqdn:
			self.fqdn = ""
			if comms:
				self.snmp = getSNMP(self.ip,self.comm)
				if not self.snmp:
					self.snmp = ""
			else:
				self.snmp = ""

#Get hostname from DNS
def getName(ip):
	host,alias,addresslist = lookup(ip)
	if host:
		fqdn = socket.getfqdn(host)
		return(fqdn)
	else:
		return

def lookup(addr):
	try:
		return socket.gethostbyaddr(addr)
	except socket.herror:
		return None,None,None

#Get SNMP system name
def getSNMP(ip,comm):
	oid = netsnmp.Varbind('iso.3.6.1.2.1.1.5.0')
	count = 0
	while (count < len(comm)):
		c = comm[count]
		sysname = netsnmp.snmpget(oid, Version = 2, DestHost = str(ip), Community = c, Timeout = 40000, Retries = 1)
		if (sysname[0]):
			break
		count += 1
	return(sysname[0])

#pind IP address and return status
def pingMe(ip):
	ip = ip.lstrip()
	ip = ip.rstrip()
	ip = ip.replace(" ","")
	RESPONSE = subprocess.call('ping -c 1 %s' %ip, shell=True, stdout = open('/dev/null', 'w'), stderr=subprocess.STDOUT)
	if RESPONSE == 0:
		alive = "Up"
	else:
		alive = "Down"
	return(alive)

def exclude(exaddr):
	com = []
	for ex in exaddr:
		if ex.find('-')!=-1:
			com.append(ex.split('-'))
		else:
			com.append(ex)

	return(com)

parser = argparse.ArgumentParser()
parser.add_argument("-n", help="Specify network address as X.X.X.X/n")
parser.add_argument("-x", help="Specify list of addresses to exclude")
parser.add_argument("-s", help="Specify list of SNMP communities")

args = parser.parse_args()
network = args.n
if args.x:
	exout = exclude(args.x.split(','))
	excount = len(exout)
else:
	excount = 0
if args.s:
	comms = args.s.split(',')
else:
	comms = None

tlist = []
queue = Queue(100)

for ip in ipaddr.IPv4Network(network).iterhosts():
	count = 0
	skip = 0
	while (count < excount):
		if isinstance(exout[count], list):
			crit = exout[count]
			if ip >= ipaddr.IPv4Address(crit[0]) and ip <= ipaddr.IPv4Address(crit[1]):
				skip = 1
		else:
			if ip == ipaddr.IPv4Address(exout[count]):
				skip = 1
		count += 1
	if skip != 1:
		thread = scan(ip,comms)
		tlist.append(thread)
		thread.start()
		queue.put(thread,True)


for t in tlist:
	t.join()
	print t.ip,","+t.status,","+t.fqdn,","+t.snmp
