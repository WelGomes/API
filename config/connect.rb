require 'dotenv/load'
require "mysql2"

class Connect 

  protected attr_writer :connect

  def initialize()

    @connect = Mysql2::Client.new(
      host: ENV["host"],
      username: ENV["username"],
      password: ENV["password"],
      database: ENV["database"]
    )

  end 

end