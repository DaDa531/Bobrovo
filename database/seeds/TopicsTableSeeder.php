<?php

use Illuminate\Database\Seeder;
use App\Topic;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics = [];

        $topics[0] = new Topic([
            'name' => 'Informácie okolo nás',
            'parent_id' => null
        ]);
        $topics[1] = new Topic([
            'name' => 'Komunikácia prostredníctvom digitálnych technológií',
            'parent_id' => null
        ]);
        $topics[2] = new Topic([
            'name' => 'Postupy, riešenie problémov, algoritmické myslenie',
            'parent_id' => null
        ]);
        $topics[3] = new Topic([
            'name' => 'Princípy fungovania digitálnych technológií',
            'parent_id' => null
        ]);
        $topics[4] = new Topic([
            'name' => 'Informačná spoločnosť',
            'parent_id' => null
        ]);

        foreach ($topics as $topic){
            $topic->save();
        }

        $subTopicNames = [
            'kódovanie, šifrovanie, komprimácia informácie',
            'číselné sústavy, prevody',
            'reprezentácia údajov v počítači - diagramy, čísla, znaky a vzťahy medzi nimi',
            'vyhľadávanie opakujúcich sa vzorov',
            'informácie zobrazené pomocou údajových štruktúr - strom, graf, zásobník',
            'výroková logika a jej využívanie pri práci s informáciami, kombinatorika',
            'textová informácia - kompetencie potrebné na prácu v textovom editore',
            'grafická informácia - kompetencie potrebné na prácu v grafickom editore',
            'číselná informácia - kompetencie potrebné na prácu v tabuľkovom editore',
            'zvuková informácia - kompetencie potrebné na prácu v zvukovom editore',
            'prezentácia informácií - kompetencie potrebné na tvorbu prezentácií',
            'prezentácia informácií na webe - kompetencie potrebné na tvorbu webových stránok',
        ];

        foreach ($subTopicNames as $item) {
            $topic = new Topic([
                'name' => $item,
                'parent_id' => $topics[0]->id
            ]);

            $topic->save();
        }
    }
}
