export interface NewUser {
  first_name: string;
  last_name: string;
  password: string;
  role: 'client' | 'dj' | null
}
