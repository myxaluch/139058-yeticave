# Get all categories
SELECT * FROM categories;

# Get new, open lots. Each lot have to includes:
# - name
# - start rate
# - image url
# - rates count
# - category name
SELECT lots.title, lots.start_rate, lots.image_url, COUNT(rates.id) AS rates_count, categories.title as category_title FROM lots
  JOIN categories ON lots.category_id = categories.id
  LEFT JOIN rates ON lots.id = rates.lot_id
  WHERE
   lots.finished_at > NOW()
  GROUP BY
    lots.title,
    lots.start_rate,
    lots.image_url,
    categories.title;

# Get lot by id, includes category name
SELECT lots.*, categories.title AS category_title FROM lots
  JOIN categories ON lots.category_id = categories.id
  WHERE lots.id = 1

# Update lot name by id
UPDATE lots SET title = '2014 Rossignol District Snowboard'
  WHERE id = 1;
