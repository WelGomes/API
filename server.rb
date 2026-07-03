require 'webrick'
require_relative 'config/routes'

server = WEBrick::HTTPServer.new(
  {
    :Port         => 8000,
  }
)

server.mount("/", Routes)

trap "INT" do
  server.shutdown()
end

server.start()
