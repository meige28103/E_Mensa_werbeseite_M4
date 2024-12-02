//1
ALTER TABLE gericht_hat_kategorie
ADD CONSTRAINT unique_gericht_kategorie UNIQUE (gericht_id, kategorie_id);
//2
CREATE INDEX gericht_name_index
ON gericht (name);
//3
ALTER TABLE gericht_hat_kategorie
ADD CONSTRAINT fk_gericht_delete
FOREIGN KEY (gericht_id)
REFERENCES gericht(id)
ON DELETE CASCADE;

ALTER TABLE gericht_hat_allergen
ADD CONSTRAINT fk_gericht_allergen_delete
FOREIGN KEY (gericht_id)
REFERENCES gericht(id)
ON DELETE CASCADE;
//4
ALTER TABLE gericht_hat_kategorie
ADD CONSTRAINT fk_kategorie_delete
FOREIGN KEY (kategorie_id)
REFERENCES kategorie(id)
ON DELETE RESTRICT;

ALTER TABLE kategorie
ADD CONSTRAINT kategorie_eltern_id
FOREIGN KEY (eltern_id)
REFERENCES kategorie(id)
ON DELETE RESTRICT;
//5
ALTER TABLE gericht_hat_allergen
ADD CONSTRAINT fk_allergen_code
FOREIGN KEY (code)
REFERENCES allergen(code)
ON UPDATE CASCADE;
//6
ALTER TABLE gericht_hat_kategorie
ADD CONSTRAINT pk_gericht_kategorie
PRIMARY KEY (gericht_id, kategorie_id);