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
            'description' => 'Informácie okolo nás',
            'parent_id' => null
        ]);
        $topics[1] = new Topic([
            'name' => 'Komunikácia prostredníctvom DT',
            'description' => 'Komunikácia prostredníctvom digitálnych technológií',
            'parent_id' => null
        ]);
        $topics[2] = new Topic([
            'name' => 'Riešenie problémov',
            'description' => 'Postupy, riešenie problémov, algoritmické myslenie',
            'parent_id' => null
        ]);
        $topics[3] = new Topic([
            'name' => 'Princípy fungovania DT',
            'description' => 'Princípy fungovania digitálnych technológií',
            'parent_id' => null
        ]);
        $topics[4] = new Topic([
            'name' => 'Informačná spoločnosť',
            'description' => 'Informačná spoločnosť',
            'parent_id' => null
        ]);

        foreach ($topics as $topic){
            $topic->save();
        }

        $subTopics = [
            ['kódovanie, šifrovanie', 'kódovanie, šifrovanie, komprimácia informácie'],
            ['číselné sústavy','číselné sústavy, prevody'],
            ['reprezentácia údajov v počítači', 'reprezentácia údajov v počítači - diagramy, čísla, znaky a vzťahy medzi nimi'],
            ['vyhľadávanie opakujúcich sa vzorov', 'vyhľadávanie opakujúcich sa vzorov'],
            ['údajové štruktúry', 'informácie zobrazené pomocou údajových štruktúr - strom, graf, zásobník'],
            ['výroková logika, kombinatorika', 'výroková logika a jej využívanie pri práci s informáciami, kombinatorika'],
            ['textová informácia', 'textová informácia - kompetencie potrebné na prácu v textovom editore'],
            ['grafická informácia', 'grafická informácia - kompetencie potrebné na prácu v grafickom editore'],
            ['číselná informácia', 'číselná informácia - kompetencie potrebné na prácu v tabuľkovom editore'],
            ['zvuková informácia', 'zvuková informácia - kompetencie potrebné na prácu v zvukovom editore'],
            ['prezentácia informácií', 'prezentácia informácií - kompetencie potrebné na tvorbu prezentácií'],
            ['prezentácia informácií na webe', 'prezentácia informácií na webe - kompetencie potrebné na tvorbu webových stránok']
        ];

        foreach ($subTopics as $item) {
            $topic = new Topic([
                'name' => $item[0],
                'description' => $item[1],
                'parent_id' => $topics[0]->id
            ]);

            $topic->save();
        }
    }
}
