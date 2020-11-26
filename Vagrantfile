# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure(2) do |config|

  config.vm.box = "generic/debian9"
  config.vm.hostname = "debian"

  config.vm.provision "shell", path: "vagrant/vagrant.sh"
  config.vm.provision :shell, :privileged => false,  :path => "vagrant/bootstrap.sh", :run => 'always'
  config.vm.network "private_network", ip: "192.168.18.11"

  if Vagrant.has_plugin?("vagrant-hostmanager")
    config.hostmanager.enabled = true
    config.hostmanager.manage_host = true

    config.vm.hostname = 'redprint.devel'
    config.vm.provision :hostmanager
  end

  if Vagrant::Util::Platform.windows?
    config.vm.synced_folder ".", "/srv/web", type: "smb"
  else
    config.vm.synced_folder ".", "/srv/web", type: "nfs", :mount_options => ['nolock,vers=3,udp,noatime,actimeo=1']
  end
  
  if Vagrant::Util::Platform.windows?
    config.vm.provider "hyperv" do |h|
      h.enable_virtualization_extensions = true 
      h.linked_clone = true
    end
  else
    config.vm.provider "virtualbox" do |vb|
      # vb.gui = true
      vb.customize ["modifyvm", :id, "--memory", "1536"]
      vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    end
  end


end
