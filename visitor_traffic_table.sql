-- Tabel untuk visitor traffic tracking
CREATE TABLE visitor_traffic (
  id SERIAL PRIMARY KEY,
  visit_timestamp TIMESTAMP NOT NULL DEFAULT NOW(),
  created_at TIMESTAMP DEFAULT NOW()
);

-- Index untuk query berdasarkan tanggal
CREATE INDEX idx_visitor_traffic_timestamp ON visitor_traffic(visit_timestamp);
CREATE INDEX idx_visitor_traffic_created_at ON visitor_traffic(created_at);

-- Tabel untuk product clicks tracking
CREATE TABLE product_clicks (
  id SERIAL PRIMARY KEY,
  product_id INTEGER NOT NULL,
  click_timestamp TIMESTAMP NOT NULL DEFAULT NOW(),
  created_at TIMESTAMP DEFAULT NOW()
);

-- Index untuk query berdasarkan product_id dan tanggal
CREATE INDEX idx_product_clicks_product_id ON product_clicks(product_id);
CREATE INDEX idx_product_clicks_timestamp ON product_clicks(click_timestamp);
