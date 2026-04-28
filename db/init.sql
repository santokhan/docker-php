-- Load schema first
SOURCE /docker-entrypoint-initdb.d/schema.sql;

-- Then seed data
SOURCE /docker-entrypoint-initdb.d/seed.sql;