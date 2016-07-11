create sequence auto_news_id;
create sequence auto_users_id;
create sequence auto_categories_id;

create table categories (
  "id" integer not null primary key default nextval('auto_categories_id'),
  "category" integer null references categories(id),
  "name" varchar(127) not null
);

create table users (
  "id" integer not null primary key default nextval('auto_users_id'),
  "login" varchar(127),
  "password" varchar(32)
);

create index users_login_password on users(login, password);

create table news (
  "id" integer not null primary key default nextval('auto_news_id'),
  "user" integer not null references users(id),
  "category" integer not null references categories(id),
  "slug" varchar(127) not null,
  "name" varchar(127) not null,
  "announce" varchar(255) not null,
  "content" text not null,
  "created_at" timestamp default (now() at time zone 'utc')
);

create index news_index_created_at on news(created_at);
create index news_index_slug on news(slug);

create table rbac_role (
  "name" varchar(127) not null unique,
  "type" integer not null default '0',
  "based" varchar(127),
  "data" text
);

create index rbac_role_based on rbac_role(based);

create table rbac_user (
  "role" varchar(127) not null references rbac_role(name),
  "user" integer not null references users(id)
);

create unique index news_rbac_user on rbac_user(role, "user");