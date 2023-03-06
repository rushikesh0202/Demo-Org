Project run steps:
a. Create Db
b. Update Db details in .env file
c. Run below commands,
   1. composer update
   2. php artisan migrate
   3.. php artisan serve
d. Following are the list of apis,
1. Register Company: http://127.0.0.1:8000/api/register
Method: GET
Headers: Accept => application/json
Body(form-data): name, email, password

2. Update Company: http://127.0.0.1:8000/api/companies/{id}
Method: PUT
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(x-www-form-urlencoded-data): name, email, address, industry, phone, mobile, fax

3. Company Details: http://127.0.0.1:8000/api/companies/{id}
Method: GET
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(form-data): no params

4. Companies List: http://127.0.0.1:8000/api/companies
Method: GET
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(form-data): no params

5. Company Delete: http://127.0.0.1:8000/api/companies/{id}
Method: DELETE
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(form-data): no params

6. Create Department: http://127.0.0.1:8000/api/departments
Method: POST
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(form-data): name, company

7. Update Department: http://127.0.0.1:8000/api/departments/{id}
Method: PUT
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(x-www-form-urlencoded-data): name, company

8. Department Details: http://127.0.0.1:8000/api/departments/{id}
Method: GET
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(form-data): no params

9. Department List: http://127.0.0.1:8000/api/departments
Method: GET
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(form-data): no params

10. Department Delete: http://127.0.0.1:8000/api/departments/{id}
Method: DELETE
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(form-data): no params

11. Create Employee: http://127.0.0.1:8000/api/employees
Method: POST
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(form-data): first_name, last_name, department, email, phone, mobile, address

12. Update Employee: http://127.0.0.1:8000/api/employees/{id}
Method: PUT
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(x-www-form-urlencoded-data): first_name, last_name, department, email, phone, mobile, address

13. Employee Details: http://127.0.0.1:8000/api/employees/{id}
Method: GET
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(form-data): no params

14. Employee List: http://127.0.0.1:8000/api/employees
Method: GET
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(form-data): no params

15. Employee Delete: http://127.0.0.1:8000/api/employees/{id}
Method: DELETE
Headers: Accept => application/json
         Authorization => {Generated token while register company} 
Body(form-data): no params
